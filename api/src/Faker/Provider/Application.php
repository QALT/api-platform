<?php

namespace App\Faker\Provider;

use App\Entity\Application as EntityApplication;
use Faker\Provider\Base;

final class Application extends Base {
    public function applicationStatus() {
        return self::randomElement(EntityApplication::STATUS);
    }
}