<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

        private SluggerInterface $slugger;
       
        public function __construct(SluggerInterface $slugger)
        {
            $this->slugger = $slugger;
        }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $seasonReference = 'season_' . $i . '_' . $j;
                for ($k = 0; $k < 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->sentence(3));
                    $episode->setSlug($this->slugger->slug($episode->getTitle()));
                    $episode->setNumber($k + 1);
                    $episode->setSynopsis($faker->paragraphs(2, true));
                    $episode->setSeason($this->getReference($seasonReference));
                    $episodeDuration = ($faker->numberBetween(22, 60));
                    $episode->setDuration($episodeDuration);
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