<?php

namespace App\Faker\Provider;

use App\Entity\PresentationPage as PresentationPageEntity;
use Faker\Provider\Base;

final class PresentationPage extends Base
{
    public function presentationPageStatus()
    {
        return self::randomElement(PresentationPageEntity::STATUS);
    }
}
