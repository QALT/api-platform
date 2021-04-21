<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;

final class Degree extends Base {
    public function degreeLabel() {
        return self::randomElement([
            'Baccalauréat',
            'BTS',
            'License',
            'Master 1',
            'Master 2'
        ]);
    }
}