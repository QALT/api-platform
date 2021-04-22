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

    public function experienceDescriptionFromLabel($label)
    {
      switch ($label) {
          case "Administrateur/Administratrice de base de données":
              return "Maintenance de plusieurs bases de données en développement, staging & production pour un site de vente de couteau papillons.";

          case "Administrateur/Administratrice de réseau":
              return "Administration de plusieurs réseau intranet et extranet pour une école d'informatique.";

          case "Architecte des systèmes d'information":
              return "Mise en place d'une architecture client/serveur pour un site de messagerie instantannée dans le secteur de la rencontre en ligne.";

          case "Architecte réseau":
              return "Mise en place de plusieurs sous-réseaux isolés pour le compte d'une entreprise de comptabilité.";

          case "Chef/Cheffe de projet informatique":
              return "Management de plusieurs projets informatique pour le compte d'une société de prestation dans la location de voitures en lignes.";

          case "Consultant/Consultante en système d'information":
              return "Conseiller dans une société dans le milieu de l'aéronautique dans le cadre d'un projet de mise en orbite d'un parc de satellite inter-connectés.";

          case "Développeur/Développeuse informatique":
              return "Développement d'un site vitrine pour le compte d'une société de vente en ligne de produit de sports.";

          case "Expert/Experte en sécurité informatique":
              return "Mise en place de plusieurs protection et sécurisation d'un site internet de plusieurs milions d'utilisateurs comportant quelques failles zero-day.";

          case "Formateur/Formatrice en informatique":
              return "Mise en place de différents cours en ligne sur la plateforme Moodle pour le cadre d'une école d'informatique sur les filières Architecture des Logiciels et Ingénierie du Web.";

          case "Gestionnaire de parc micro-informatique":
              return "Mise en place et gestion d'un parc de plusieurs appareils connectés en local et dans le cloud pour le compte d'une société de vente en lignes de solution types ERP et CRM.";

          case "Hot liner":
              return "Mise en place d'un workflow d'appel pour pouvoir répondre de manière précise et pertinentes aux questions des clients lors d'appel à la société.";

          case "Informaticien industriel/Informaticienne industrielle":
              return "Mise en place d'une solution en Python pour automatiser les tests industriels d'une carte mémoire type RAM pour le compte d'une société de vente de carte graphiques.";

          case "Ingénieur/Ingénieure cloud computing":
              return "Mise en place d'une architecture AWS avec Ansible et Terraform pour automatiser la réplication et la création d'une architecture client/serveur pour une société de ventes de produits numériques en ligne.";

          case "Ingénieur/Ingénieure en métrologie":
              return "Mise en place d'une automatisation des tests métrologiques servant de bases à l'équipe marketing pour l'élaboration de statistiques techniques et fonctionnelles pour la vente d'un nouveau MVP.";

          case "Ingénieur/Ingénieure études et développement en logiciel de simulation":
              return "Mise en place d'un système permettant d'ajouter des plugins à un simulateur de conduite automobile pour nos fournisseurs constructeurs leur permettant de créer leur propre voiture sur nos outils.";

          case "Ingénieur/Ingénieure système":
              return "Mise en place d'un script d'automatisation d'installation du système d'exploitation GNU/ArchLinux pour la mise en place d'un parc de test de plusieurs centaines d'ordinateurs pour un le clien final.";

          case "Ingénieur/Ingénieure télécoms et réseaux":
              return "Mise en place d'un système de détection de malwares téléphonique publicitaires sur un flagship MVP d'une société OEM constructeur d'un nouveau modèle d'appareil mobile.";

          case "Ingénieur technico-commercial en informatique/Ingénieure technico-commerciale en informatique":
              return "Gestion des différents catalogues de produits et lead de campagne de vente dans une société de ventes de produits/services lié au monde du luxe.";

          case "Technicien/Technicienne de maintenance en informatique":
              return "Mise en place d'une routine de vérification des issues et incidents dans le cadre du support de niveau 2 dans une sociéte de vente de produits Microsoft Cloud.";

          case "Technicien/Technicienne télécoms et réseaux":
              return "Mise en place d'un système de détection de malwares téléphonique publicitaires sur un flagship MVP d'une société OEM constructeur d'un nouveau modèle d'appareil mobile.";

          case "Testeur/Testeuse":
              return "Mise en place d'une routine de tests unitaires, fonctionnels et E2E pour le compte d'une entreprise de vente de services en lignes liés à la sécurité des systèmes réseaux militaires.";

          default:
              return "Mise en place d'une routine de tests unitaires, fonctionnels et E2E pour le compte d'une entreprise de vente de services en lignes liés à la sécurité des systèmes réseaux militaires.";
      }
    }
}
