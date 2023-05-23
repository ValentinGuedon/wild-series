<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);

        $program2 = new Program();
        $program2->setTitle('Tchoupi');
        $program2->setSynopsis('Je ne sais même pas quel animal c\'est');
        $program2->setCategory($this->getReference('category_Animation'));
        $manager->persist($program2);

        $program3 = new Program();
        $program3->setTitle('The Witcher');
        $program3->setSynopsis('Des mucles seyants et des grosses épées!');
        $program3->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program3);

        $program4 = new Program();
        $program4->setTitle('Joséphine ange gardien');
        $program4->setSynopsis('Parceque pourquoi pas?');
        $program4->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program4);

        $program5 = new Program();
        $program5->setTitle('American horror stories');
        $program5->setSynopsis('La fin n\'a aucun sens');
        $program5->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program5);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}
