<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 Documents
        for ($i = 0; $i < 10; $i++) {
            $document = new \App\Entity\Document();
            $document->setDoi('10-'.$faker->numberBetween(10000,99999))
            ->setTitle($faker->text)
            ->setCreatedA(new \DateTime())
            ->setSummuray($faker->text);
            $manager->persist($document);
        }
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

            $manager->persist($contributor);
        }

        $manager->flush();
    }
}
