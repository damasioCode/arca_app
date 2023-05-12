<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create object of Category insert in to DB
        $category1 = new Category();
        $category1->setName('Auto');
        $category1->setDescription('Auto Description');
        
        $category2 = new Category();
        $category2->setName('Beauty and Fitness');
        $category2->setDescription('Beauty and Fitness Description');
        
        $category3 = new Category();
        $category3->setName('Entertainment');
        $category3->setDescription('Entertainment Description');
        
        $category4 = new Category();
        $category4->setName('Food and Dining');
        $category4->setDescription('Food and Dining Description');
        
        $category5 = new Category();
        $category5->setName('Health');
        $category5->setDescription('Health Description');
        
        $category6 = new Category();
        $category6->setName('Sports');
        $category6->setDescription('Sports Description');
        
        $category7 = new Category();
        $category7->setName('Travel');
        $category7->setDescription('Travel Description');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);
        $manager->persist($category7);

        $manager->flush();
    }
}
