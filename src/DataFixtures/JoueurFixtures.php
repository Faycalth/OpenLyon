<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Joueur;

class JoueurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i=0; $i<32; $i++){
            $joueur = new Joueur();
            $joueur->setNom($faker->lastName())
                    ->setPrenom($faker->firstName($gender = 'male'))
                    ->setClassementatp($faker->numberBetween($min=1, $max=150))
                    ->setAge($faker->numberBetween($min=20, $max=40))
                    ->setNationalite($faker->country())
                    ->setPoids($faker->numberBetween($min=60, $max=90))
                    ->setTaille($faker->numberBetween($min=160, $max=190))
                    ->setImage($faker->imageUrl($width = 640, $height = 480));

            
            $manager->persist($joueur);
        }

        $manager->flush();
    }
}
