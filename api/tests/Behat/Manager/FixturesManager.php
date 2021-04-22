<?php

namespace App\Tests\Behat\Manager;

use Fidry\AliceDataFixtures\ProcessorInterface;

class FixturesManager implements ProcessorInterface {
    /**
     * @inheritdoc
     */
    public function preProcess(string $id, $object): void {
        // do nothing
    }

    /**
     * @inheritdoc
     * @throws \Exception
     */
    public function postProcess(string $id, $object): void {
        if (method_exists($object, 'getId')) {
            ReferencesManager::addReference($id, $object->getId());
        }
    }
}