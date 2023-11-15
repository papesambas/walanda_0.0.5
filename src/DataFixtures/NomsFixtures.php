<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Noms;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NomsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 100; $i++) {
            $nom = new Noms();
            $nom->setDesignation($faker->unique()->lastName);
            $manager->persist($nom);
            $this->addReference('nom_' . $i, $nom);
        }

        $manager->flush();
    }
}
