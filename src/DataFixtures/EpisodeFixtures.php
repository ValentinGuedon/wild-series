<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $seasonReference = 'season_' . $i . '_' . $j;
                for ($k = 0; $k < 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence());
                    $episode->setNumber($k + 1);
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setSeason($this->getReference($seasonReference));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}