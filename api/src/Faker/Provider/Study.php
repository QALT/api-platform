<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;

final class Study extends Base
{
    public function studyLabel()
    {
        return self::randomElement([
            "Architecture des Logiciels",
            "Mobilité et Objets Connectés",
            "Ingénierie de la 3D et des Jeux Vidéos",
            "Systèmes, Réseaux et Cloud Computing",
            "Ingénierie du Web",
            "Sécurité Informatique",
            "Ingénierie de la Blockchain",
            "Intelligence Artificielle et Big Data",
            "Management et Conseil en Système d'Information"
        ]);
    }

    public function studySchool()
    {
        return self::randomElement([
            "EPITA",
            "EPITECH",
            "ESGI",
            "ÉSTIAM",
            "IN'TECH",
            "École Iris",
            "INGETIS",
            "Info'Sup",
            "IPSSI",
        ]);
    }
}
