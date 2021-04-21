<?php

namespace App\Faker\Provider;

use App\Entity\Application as EntityApplication;
use Faker\Provider\Base;

final class Application extends Base
{
    public function applicationStatus()
    {
        return self::randomElement(EntityApplication::STATUS);
    }

    public function applicationCommentFromStatus($status)
    {
        switch ($status) {
            case EntityApplication::REFUSED:
                return self::randomElement([
                    "La personne n'a pas les compétences nécessaires malgré le profil annoncé.",
                    "La personne a peu d'expérience malgré le profil annoncé.",
                    "La personne a des espérances salariales trop élevées par rapport à ce qui est proposé.",
                    "La personne n'a pas les compétences nécessaires malgré le profil annoncé.",
                    "La personne manque de motivation pour le poste proposé.",
                    "La personne est arabe.",
                    "La personne est handicapée.",
                    "La personne n'a pas été pris car un autre candidat s'est démarqué."
                ]);

            case EntityApplication::ACCEPTED:
                return self::randomElement([
                    "La personne a pas les compétences nécessaires au poste.",
                    "La personne a beaucoup d'expérience.",
                    "La personne a des espérances salariales qui correspondent à ce qui est proposé.",
                    "La personne est très motivée pour ce poste.",
                    "La personne a sû se démarquer des autres."
                ]);

            default:
                return "N/A.";
        }
    }
}
