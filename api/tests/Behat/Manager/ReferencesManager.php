<?php

namespace App\Tests\Behat\Manager;

class ReferencesManager {
    public static $references = [];

    public static function getReferences() {
        return self::$references;
    }

    public static function getReference($index) {
        return self::$references[$index] ?? null;
    }

    public static function addReference($index, $value) {
        self::$references[$index] = $value;
    }

    public static function deleteReference($index) {
        unset(self::$references[$index]);
    }
}