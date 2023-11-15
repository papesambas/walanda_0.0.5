<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Peres;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PeresFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $allPhoneNumbers = range(1, 300); // Créer un tableau avec tous les numéros de téléphone disponibles
        shuffle($allPhoneNumbers); // Mélanger les numéros

        for ($i = 1; $i <= 100; $i++) {
            $profession = $this->getReference('profession_' . $faker->numberBetween(1, 250));
            $pere = new Peres();

            // Utiliser le premier numéro disponible comme telephone1
            $telephone1Id = array_shift($allPhoneNumbers);
            $telephone1 = $this->getReference('telephone_' . $telephone1Id);

            // Utiliser le deuxième numéro disponible comme telephone2
            $telephone2Id = array_shift($allPhoneNumbers);
            $telephone2 = $this->getReference('telephone_' . $telephone2Id);

            $pere->setNom($this->getReference('nom_' . $faker->numberBetween(1, 50)));
            $pere->setPrenom($this->getReference('prenom_' . $faker->numberBetween(1, 100)));
            $pere->setProfession($profession);
            $pere->setTelephone1($telephone1);
            $pere->setTelephone2($telephone2);

            $manager->persist($pere);
            $this->addReference('pere_' . $i, $pere);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ProfessionsFixtures::class,
        ];
    }
}
