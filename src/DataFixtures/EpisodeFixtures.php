<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'title' => "Episode 1",
            'number' => 1,
            'synopsis' => 'Premier episode',
        ],
        [
            'title' => "Episode 2",
            'number' => 2,
            'synopsis' => 'deuxième episode',
        ],
        [
            'title' => "Episode 3",
            'number' => 3,
            'synopsis' => 'troisieme episode',
        ],
        [
            'title' => "Episode 4",
            'number' => 4,
            'synopsis' => 'quatrieme episode',
        ],
        [
            'title' => "Episode 5",
            'number' => 5,
            'synopsis' => 'Cinquieme episode',
        ],
        [
            'title' => "Episode 6",
            'number' => 5,
            'synopsis' => 'Sixieme episode',
        ],
        [
            'title' => "Episode 7",
            'number' => 5,
            'synopsis' => 'septieme episode',
        ],
        [
            'title' => "Episode 8",
            'number' => 5,
            'synopsis' => 'huitieme episode',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (ProgramFixtures::PROGRAMS as $programTitle => $programDescription) {
            foreach (SeasonFixtures::SAISONS as $seasonTitle => $seasonDescription) {
                foreach (self::EPISODES as $number => $episodeDescription) {
                    $episode = new Episode();
                    $episode->setTitle($episodeDescription['title']);
                    $episode->setNumber($episodeDescription['number']);
                    $episode->setSynopsis($episodeDescription['synopsis']);
                    $episode->setSeason($this->getReference('season_'. $programTitle . '_' . $seasonTitle));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}