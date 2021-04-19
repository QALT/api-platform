<?php

namespace App\Faker\Provider;

use App\Entity\Offer as EntityOffer;
use Faker\Provider\Base;

final class Offer extends Base {
    public function offerStatus() {
        return self::randomElement(EntityOffer::STATUS);
    }
}