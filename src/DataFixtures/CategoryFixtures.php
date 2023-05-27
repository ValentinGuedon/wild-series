<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture 
{
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(ObjectManager $manager)
    {
       foreach (self::CATEGORIES as $key => $CategoryName){
        $category = new Category();
        $category->setName($CategoryName);
        $manager->persist($category);

        $this->addReference('category_' . $CategoryName, $category);
       }
       $manager->flush();
    }
}