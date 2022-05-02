<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   $faker = Factory::create(); 
        for ($i=0; $i < 20 ;$i++) {
            $voiture = new Voiture();
            $voiture->setMarque($faker->lastName );
            
            $manager->persist($voiture);

            
        }
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

       
    }
}
