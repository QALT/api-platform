<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;
use Faker\Factory;

final class Message extends Base
{
    public function messageContent()
    {
        return self::randomElement([
            "Bonjour, comment allez-vous ?",
            "Bonjour, ça va très bien merci et vous ?",
            "Bonjour, je vous contacte pour savoir si vous êtes toujours à l'écoute d'opportunités ?",
            "Bonjour, j'aimerais avoir plus de détails sur l'offre que vous avez publié hier matin ?",
            "Bonjour, est-ce qu'il serait possible d'effectuer la mission proposée à distance ?",
            "Bonjour, quels sont vos espérances salariales pour le poste que vous recherchez ?",
            "Bonjour, quel est le critère déterminant pour démarquer deux candidats ?"
        ]);
    }
}
