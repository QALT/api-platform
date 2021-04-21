<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;
use Faker\Factory;

final class Experience extends Base
{
    public function experienceLabel()
    {
        return self::randomElement([
            "Administrateur/Administratrice de base de données",
            "Administrateur/Administratrice de réseau",
            "Architecte des systèmes d'information",
            "Architecte réseau",
            "Chef/Cheffe de projet informatique",
            "Consultant/Consultante en système d'information",
            "Développeur/Développeuse informatique",
            "Expert/Experte en sécurité informatique",
            "Formateur/Formatrice en informatique",
            "Gestionnaire de parc micro-informatique",
            "Hot liner",
            "Informaticien industriel/Informaticienne industrielle",
            "Ingénieur/Ingénieure cloud computing",
            "Ingénieur/Ingénieure en métrologie",
            "Ingénieur/Ingénieure études et développement en logiciel de simulation",
            "Ingénieur/Ingénieure système",
            "Ingénieur/Ingénieure télécoms et réseaux",
            "Ingénieur technico-commercial en informatique/Ingénieure technico-commerciale en informatique",
            "Technicien/Technicienne de maintenance en informatique",
            "Technicien/Technicienne télécoms et réseaux",
            "Testeur/Testeuse"
        ]);
    }

    public function experienceDateBetween($startDate, $endDate)
    {
        return Factory::create()->dateTimeBetween($startDate, $endDate)->format("Y-m-d");
    }
}
