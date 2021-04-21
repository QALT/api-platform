<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;

final class Tag extends Base {
    public function tagLabel() {
        return self::randomElement([
            'Symfony',
            'Front',
            'Back',
            'SIRH',
            'PHP',
            'JS',
            'Prisma',
            'API',
            'Go',
            'Python'
        ]);
    }
}