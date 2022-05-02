<?php

namespace App\DataFixtures;
use App\Entity\Personnes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Faker;
use App\Entity\Voiture;
use Faker\Factory;
class Personnesf extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();       
         for ($i=0; $i < 20 ;$i++) {
            $personne = new Personnes();
            $personne->setNom($faker->lastName );
            $personne->setPrenom($faker->firstName );
            $personne->setAge($faker->numberBetween(18,65));
            $personne->setEmail($faker->email);
            $manager->persist($personne);

            
        }
        $manager->flush();

        
    }
}

