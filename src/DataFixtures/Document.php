<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Document extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $manager->flush();
    }
}
