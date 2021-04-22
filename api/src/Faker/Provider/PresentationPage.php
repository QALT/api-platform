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

    public function presentationPageContent()
    {
        return self::randomElement([
            "Ayant 5 ans d'expériences dans le domaine du réseau militaire, je suis à l'écoute du marché des réseaux et des télécoms.",
            "Ayant 2 ans d'expériences dans le domaine du développement web, je suis à l'écoute du marché du logiciel applicatif web.",
            "Ayant 7 ans d'expériences dans le domaine du marketing, je suis à l'écoute du marché de l'e-commerce et du luxe.",
            "Ayant 3 ans d'expériences dans le domaine du cloud computing, je suis à l'écoute du marché sur des postes types AWS Cloud Manager ou Azure Cloud.",
            "Ayant 5 ans d'expériences dans le domaine de la sécurité, je suis à l'écoute du militaire et des réseaux/télécoms.",
        ]);
    }
}
