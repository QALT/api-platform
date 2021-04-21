<?php

declare(strict_types=1);

namespace App\Tests\Behat\Contexts;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Fidry\AliceDataFixtures\Loader\PersisterLoader;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

final class RestContext extends ApiTestCase implements Context
{
    use RefreshDatabaseTrait;
    use HeaderContextTrait;
    use FixturesContextTrait;

    /** @var Response|null */
    private $response;

    private $responseContent;

    /** @var PyStringNode */
    private $payload;

    /** @var PropertyAccess */
    private $propertyAccessor;

    /** @var PersisterLoader */
    private $fixturesLoader;

    /** @var string */
    private $token;

    private $references;

    public function __construct(KernelInterface $kernel) {
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
            case 'employee':
                $options['body'] = json_encode([
                    'email' => 'employee@gmail.com',
                    'password' => 'Password'
                ]);
                break;
            case 'employer':
                $options['body'] = json_encode([
                    'email' => 'employer@gmail.com',
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
        $this->iSetHeaderToBe('Authorization', "Bearer $response->token");
    }

    /**
     * @param PyStringNode $payload
     * @When I have The Payload
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
            $options['body'] = $this->payload->getRaw();
            $this->payload = null;
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
        $this->references[$reference] = $this->responseContent;
        var_dump($this->references);
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
}
