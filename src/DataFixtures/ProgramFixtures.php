<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence());
            $program->setSynopsis($faker->paragraphs(3, true));
            $program->setCountry($faker->country());
            $program->setYear($faker->year());
            $program->setPoster('https://picsum.photos/id/237/200/300');
            $randomCategoryKey = array_rand(CategoryFixtures::CATEGORIES);
            $categoryName = CategoryFixtures::CATEGORIES[$randomCategoryKey];
            $program->setCategory($this->getReference('category_' . $categoryName));
            $this->addReference('program_' . $i, $program);
            $manager->persist($program);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}














// public const PROGRAMS = [
//     ['title' =>'Walking dead',
//     'synopsis'=>'Des zombies envahissent la terre',
//     'category'=>'Action'
//  ],
//  [
//      'title' =>'Tchoupi',
//      'synopsis'=>'Je ne sais même pas quel animal c\'est',
//      'category'=>'Animation' 
//  ],
//  [
//     'title' =>'The Witcher',
//     'synopsis'=>'Des mucles seyants et des grosses épées!',
//     'category'=>'Aventure'
//  ],
//  [
//      'title' =>'American horror stories',
//      'synopsis'=>'La fin n\'a aucun sens',
//      'category'=>'Horreur' 
//  ],
//  [
//      'title' =>'Joséphine ange gardien',
//      'synopsis'=>'Parceque pourquoi pas?',
//      'category'=>'Fantastique' 
//  ]
//  ];

//  public function load(ObjectManager $manager)
//  {
//      foreach (self::PROGRAMS as $programData) {
//          $program = new Program();
//          $program->setTitle($programData['title']);
//          $program->setSynopsis($programData['synopsis']);
//          $program->setCategory($this->getReference($programData['category']));
//          $manager->persist($program);
         
//      }
//      $manager->flush();
//  }

// public function getDependencies()
// {
//     return [
//       CategoryFixtures::class,
//     ];
// }