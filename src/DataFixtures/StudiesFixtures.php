<?php

namespace App\DataFixtures;

use App\Entity\Studies;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudiesFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        /* Utilisateur Dev */
        $college = new Studies();
        $college->setPlace('Collège les Courtils');
        $college->setAddress('4 Rue du Clos, 50590 Montmartin-sur-Mer');
        $college->setText('Etudes de la 6ème à la 3ème générale');
        $college->setWebsite('https://www.facebook.com/p/Collège-Les-Courtils-Montmartin-officiel-100054351049822/?locale=fr_FR');
        $college->setYears('2015 - 2019');
        $manager->persist($college);

        $brevet = new Studies();
        $brevet->setPlace('Brevet Général');
        $brevet->setAddress('4 Rue du Clos, 50590 Montmartin-sur-Mer');
        $brevet->setText('Optention du brevet général');
        $brevet->setYears('2019');
        $manager->persist($brevet);

        $lycee = new Studies();
        $lycee->setPlace('CMN Coutances');
        $lycee->setAddress('La Quibouquière, 50200 Coutances');
        $lycee->setText('2nd Générale et Technologique, 1ère & Terminale STAV   ');
        $lycee->setYears('2019 - 2022');
        $manager->persist($lycee);

        $bac = new Studies();
        $bac->setPlace('Baccalauréat STAV');
        $bac->setAddress('La Quibouquière, 50200 Coutances');
        $bac->setText('Optention du baccalauréat STAV');
        $bac->setWebsite('https://www.campusagri.fr');
        $bac->setYears('2022');
        $manager->persist($bac);

        $bts = new Studies();
        $bts->setPlace('Lycée NDLP');
        $bts->setAddress('9 Rue Chanoine Berenger, 50300 Avranches');
        $bts->setText('BTS SIO OPT. SLAM (en cours) | 1ère année : Participation au programme de mini-entreprise (PikPik)');
        $bts->setWebsite('https://ndlpavranches.fr');
        $bts->setYears('2022 - 2024');
        $manager->persist($bts);

    
        $manager->flush();



    }
}