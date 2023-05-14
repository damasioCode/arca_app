<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create object of Category insert in to DB
        $user = new User();
        $user->setName('Admin');
        $user->setEmail('admin@gmail.com');
        $user->setPassword('admin123');

        $manager->persist($user);

        $manager->flush();
    }
}
