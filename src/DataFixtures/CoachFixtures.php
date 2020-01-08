<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Joueur;
use App\Repository\JoueurRepository;
use App\Entity\Coach;

class CoachFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');


        for($i=0; $i<32; $i++){
            $joueur = new Joueur();

            $coach = new Coach();
            $coach->setJoueur($joueur->getId())
                    ->setNom($faker->lastName())
                    ->setPrenom($faker->firstName($gender = 'male'))
                    ->setAge($faker->numberBetween($min=20, $max=40))
                    ->setNationalite($faker->country());

            $manager->persist($coach);
        }

        $manager->flush();
    }
}
