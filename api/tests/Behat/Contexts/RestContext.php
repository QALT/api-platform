<?php

declare(strict_types=1);

namespace App\Tests\Behat\Contexts;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Behat\Manager\FixturesManager;
use App\Tests\Behat\Manager\ReferencesManager;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Fidry\AliceDataFixtures\Loader\PersisterLoader;
use Firebase\JWT\JWT;
use Hautelook\AliceBundle\PhpUnit\BaseDatabaseTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

final class RestContext extends ApiTestCase implements Context {
    use HeaderContextTrait;
    use FixturesContextTrait;
    use BaseDatabaseTrait;
    use HookContextTrait;

    /** @var Response|null */
    private $response;

    private $responseContent;

    /** @var PyStringNode */
    private $payload;

    /** @var PropertyAccess */
    private $propertyAccessor;

    /** @var PersisterLoader */
    private $fixturesLoader;

    /** @var FixturesManager */
    private $fixturesManager;

    /** @var string */
    private $token;

    public function __construct(KernelInterface $kernel, FixturesManager $fixturesManager) {
        parent::__construct();
        $this->fixturesLoader = $kernel->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');
        $this->propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
        ->disableExceptionOnInvalidPropertyPath()
        ->getPropertyAccessor();
    }

    /**
     * @When I am logged as :userType
     */
    public function iAmLogged($userType) {
        $options = [
            'headers' => $this->headers,
        ];

        switch ($userType) {
            case 'employee1':
                $options['body'] = json_encode([
                    'email' => 'employee1@gmail.com',
                    'password' => 'Password'
                ]);
                break;
            case 'employee2':
                $options['body'] = json_encode([
                    'email' => 'employee2@gmail.com',
                    'password' => 'Password'
                ]);
                break;
            case 'employer1':
                $options['body'] = json_encode([
                    'email' => 'employer1@gmail.com',
                    'password' => 'Password'
                ]);
                break;
            case 'employer2':
                $options['body'] = json_encode([
                    'email' => 'employer2@gmail.com',
                    'password' => 'Password'
                ]);
                break;
            case 'admin':
                $options['body'] = json_encode([
                    'email' => 'admin@gmail.com',
                    'password' => 'Password'
                ]);
                break;
        }

        $response = $this->createClient()->request('POST', '/authentication_token', $options);
        $response = json_decode($response->getContent());

        $key = file_get_contents(__DIR__ . '/../../../config/jwt/public.pem');
        $payload = JWT::decode($response->token, $key, ['RS256']);
        ReferencesManager::addReference('user_auth', $payload);
        $this->iSetHeaderToBe('Authorization', "Bearer $response->token");
    }

    /**
     * @param PyStringNode $payload
     * @When I have the Payload
     */
    public function iHavePayload(PyStringNode $payload) {
        $this->payload = $payload;
    }

    /**
     * @When I request :method :path
     */
    public function iSendARequestTo($method, $path) {
        $options = ['headers' => $this->headers];

        if ($this->payload) {
            $payload = json_decode($this->payload->getRaw());
            foreach ($payload as $key => $param) {
                if(gettype($param) != "string"){
                    continue;
                }
                $regex = '/({(?<entity>.*?)\.(?<value>.*?)})/';
                $matches = [];
                preg_match($regex, $param, $matches);

                if (!empty($matches)) {
                    ['entity' => $entity, 'value' => $value] = $matches;
                    $referenceValue = ReferencesManager::getReference($entity);

                    if (!$referenceValue) {
                        throw new \Exception("Index $entity not found in references");
                    }

                    $route = $entity === 'user_auth' ? 'users' : $entity . 's';
                    $payload->$key = "/api/$route/{$referenceValue}";
                }
            }
            
            $options['body'] = json_encode($payload);
            $this->payload = null;
        }

        $regex = '/({(?<entity>.*?)})/';
        $matches = [];
        preg_match($regex, $path, $matches);

        if (!empty($matches)) {
            ['entity' => $entity] = $matches;
            $referenceValue = ReferencesManager::getReference($entity);

            if (!$referenceValue) {
                throw new \Exception("Index $entity not found in references");
            }

            $route = $entity === 'user_auth' ? 'users' : explode('_', $entity)[0] . 's';
            $path = "/api/$route/$referenceValue";
        }

        $this->response = $this->createClient()->request($method, $path, $options);

        if ($this->response->getStatusCode() < 300) {
            $this->responseContent = json_decode($this->response->getContent());
        }
    }

    /**
     * @Then the response status code should be :statusCode
     */
    public function theResponseStatusCodeShouldBe($statusCode) {
        var_dump($this->response->getStatusCode());
        if ($this->response->getStatusCode() != $statusCode) {
            throw new \RuntimeException('No response received');
        }
    }

    /**
     * @Then I add a reference :reference
     */
    public function iAddAReference($reference) {
        ReferencesManager::addReference($reference, $this->propertyAccessor->getValue($this->responseContent, 'id'));
    }

    /**
     * @Then the response should contain key :key
     */
    public function theResponseShouldContain($key) {
        assertTrue($this->propertyAccessor->getValue($this->responseContent, $key) !== null);
    }

    /**
     * @Then the response should not contain key :key
     */
    public function theResponseShouldNotContain($key) {
        assertFalse($this->propertyAccessor->getValue($this->responseContent, $key) !== null);
    }

    /**
     * @Then the response should contain key :key with value :value
     */
    public function theResponseShouldContainWithValue($key, $value) {
        $this->theResponseShouldContain($key);
        assertEquals($this->propertyAccessor->getValue($this->responseContent, $key), $value);
    }

    /**
     * @Then I am logged out
     */
    public function iAmLoggedOut() {
        ReferencesManager::deleteReference('user_auth');
        ReferencesManager::deleteReference('Authorization');
    }
}
