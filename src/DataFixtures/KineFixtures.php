<?php

namespace App\DataFixtures;

use App\Entity\Kine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class KineFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $kine = new Kine();
            $kine->setFirstname("kine$i");
            $kine->setLastname("therapeutics$i");
            $kine->setEmail("kine$i@gmail.com");

            $manager->persist($kine);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }
}
