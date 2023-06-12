<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            
            $manager->persist($actor);

            $programs = $manager->getRepository(Program::class)->findAll();
            $randomPrograms = $faker->randomElements($programs, 3);

            foreach ($randomPrograms as $program) {
                $actor->addProgram($program);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    }
}
