<?php

namespace App\Tests\Behat\Contexts;

use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterScenarioScope;

trait HookContextTrait {
    /**
     * @BeforeSuite
     */
    public static function beforeSuite(BeforeSuiteScope $scope) {
        static::ensureKernelTestCase();
        parent::bootKernel();
        static::populateDatabase();
    }

    /**
     * @BeforeScenario
     */
    public static function beforeScenario(BeforeScenarioScope $scope) {
        $container = static::$container ?? static::$kernel->getContainer();
        $container->get('doctrine')->getConnection(static::$connection)->beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public static function afterScenario(AfterScenarioScope $scope) {
        $container = static::$container ?? static::$kernel->getContainer();
        $connection = $container->get('doctrine')->getConnection(static::$connection);
        if ($connection->isTransactionActive()) {
            $connection->rollback();
        }
    }
}
