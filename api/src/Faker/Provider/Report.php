<?php

namespace App\Faker\Provider;

use App\Entity\Report as ReportEntity;
use Faker\Provider\Base;

final class Report extends Base
{
    public function reportStatus()
    {
        return self::randomElement(ReportEntity::STATUS);
    }

    public function reportMotivation()
    {
      return self::randomElement([
        "Cette offre demande une expérience de 10 ans pour un langage qui existe depuis 5 ans",
        "Cette offre est sexiste vis-à-vis des femmes",
        "Cette offre demande beaucoup trop de technologies pour une seule personne",
        "Cette offre se base sur des critères physiques qui n'ont rien à voir avec le poste",
        "Cette offre met de côté les personnes à handicap alors que cela n'a aucun rapport avec le poste"
      ]);
    }
}
