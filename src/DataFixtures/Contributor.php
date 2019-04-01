<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class Contributor extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 Contributors
        for ($i = 0; $i < 10; $i++) {
            $contributor = new \App\Entity\Contributor();
            $contributor->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setComplementName($faker->lastName)
                ->setCivility('Mr')
                ->setEmail($faker->email)
                ->setPhoto($faker->image())
                ->setLogin($faker->userName)
                ->setPwd($faker->password);

            $manager->flush();
        }
    }
}
