<?php

namespace App\Faker\Provider;

use App\Entity\Offer as EntityOffer;
use Faker\Provider\Base;

final class Offer extends Base
{
    public function offerStatus()
    {
        return self::randomElement(EntityOffer::STATUS);
    }

    public function offerTitle()
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

    public function offerDescription($title)
    {
        switch ($title) {
            case "Administrateur/Administratrice de base de données":
                return "Vous serez amené à administrer plusieurs base de données.";

            case "Administrateur/Administratrice de réseau":
                return "Vous serez amené à administrer un réseau informatique de plusieurs dizaines d'ordinateurs.";

            case "Architecte des systèmes d'information":
                return "Vous serez amené à améliorer l'architecture actuel du système d'information.";

            case "Architecte réseau":
                return "Vous serez amené à améliorer le parc informatique d'un réseau de plusieurs dizaines d'ordinateurs.";

            case "Chef/Cheffe de projet informatique":
                return "Vous serez le référent et le responsable de plusieurs projets informatique au sein de notre société.";

            case "Consultant/Consultante en système d'information":
                return "Vous serez force de proposition quand à la prise de décision concernant nos projets informatique au sein de notre société.";

            case "Développeur/Développeuse informatique":
                return "Vous serez amené à développer le système d'information ainsi que l'interface utilisateur de notre application.";

            case "Expert/Experte en sécurité informatique":
                return "Vous serez amené à prévenir et à corriger les éventuelles failles de sécurité du système d'information actuel et à le renforcer au sein de notre SOC.";

            case "Formateur/Formatrice en informatique":
                return "Vous serez amené à donner des conférences dans notre société concernant les technologies du Web et de la programmation fonctionnelle et orientée objet, les bonnes pratiques de développement etc...";

            case "Gestionnaire de parc micro-informatique":
                return "Vous serez amené à être le référent et technicien du parc informatique actuel en tant que support de niveau 2.";

            case "Hot liner":
                return "Vous serez amené à répondre au standard téléphonique de la société, de présenter cette dernière et de donner tous les renseignements nécessaires aux clients.";

            case "Informaticien industriel/Informaticienne industrielle":
                return "Vous serez amené à automatiser le processus de production de notre carte mère afin d'accélérer les rendements et permettre d'améliorer la croissance de l'entreprise.";

            case "Ingénieur/Ingénieure cloud computing":
                return "Vous serez amené à digitaliser la société sur les outils qu'elle utilisent en local et lui permettre d'y accéder depuis n'importe où en facilitant le travail des collaborateurs en déplacement.";

            case "Ingénieur/Ingénieure en métrologie":
                return "Vous serez amené à prévoir la météo à 1 an, sans vous tromper et en étant parfaitement sûr des conditions météorologique afin de permettre d'anticiper les croissance agrologique de notre société de création de pousse de bambou.";

            case "Ingénieur/Ingénieure études et développement en logiciel de simulation":
                return "Vous serez amené à participer au développement d'un testeurs de RAM afin de permettre d'automatiser le processus d'exploitation et permettre d'accélerer la production en réduisant au maximum les fautes de conception.";

            case "Ingénieur/Ingénieure système":
                return "Vous serez amené à développer le système d'exploitation Linux et plus particulièrement son noyau Linux en lien avec notre pilote graphique GPU et permettre son adoption.";

            case "Ingénieur/Ingénieure télécoms et réseaux":
                return "Vous serez amené à développer le système de télécommunication de grade militaire afin de permettre l'établissement de connexion sécurisées et chiffrées pour nos troupes en déplacements au Sahel et en Iran.";

            case "Ingénieur technico-commercial en informatique/Ingénieure technico-commerciale en informatique":
                return "Vous serez amené à développer et pousser la vente de notre CRM aux entreprise du monde de la joailerie et du luxe afin de permettre sa découverte et de répandre le mot auprès de nos partenaires pour pouvoir leur faire découvrir une solution adaptée à leur besoins.";

            case "Technicien/Technicienne de maintenance en informatique":
                return "Vous serez amené, en tant que support de niveau 3, à répondre aux appels téléphoniques des collaborateurs ayant des soucis sur leurs ordinateurs personnels mais aussi en déplacement et vous serez en charge de leur apporter un soutien et un support 24/7.";

            case "Technicien/Technicienne télécoms et réseaux":
                return "Vous serez amené à développer le système de télécommunication de grade militaire afin de permettre l'établissement de connexion sécurisées et chiffrées pour nos troupes en déplacements au Sahel et en Iran.";

            case "Testeur/Testeuse":
                return "Vous serez amené à tester notre dernière application mobile écrite en React Native afin de permettre de chasser tous les bugs et de faire remonter des suggestions d'améliorations de ce dernier et pouvoir au final améliorer sa qualité et son adoption sur les stores.";

            default:
                return "Vous serez amené à tester notre dernière application mobile écrite en React Native afin de permettre de chasser tous les bugs et de faire remonter des suggestions d'améliorations de ce dernier et pouvoir au final améliorer sa qualité et son adoption sur les stores.";

        }
    }
}
