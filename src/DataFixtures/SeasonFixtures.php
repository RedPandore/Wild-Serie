<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SAISONS = [
        'S01' => [
            'number' => 1,
            'description' => 'Saison 1',
            'year' => 2021
        ],
        'S02' => [
            'number' => 2,
            'description' => 'Saison 2',
            'year' => 2022
        ],
        'S03' => [
            'number' => 3,
            'description' => 'Saison 3',
            'year' => 2023
        ],
        'S04' => [
            'number' => 4,
            'description' => 'Saison 4',
            'year' => 2024
        ],
        'S05' => [
            'number' => 5,
            'description' => 'Saison 5',
            'year' => 2025
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (ProgramFixtures::PROGRAMS as $title => $description) {
            foreach (self::SAISONS as $number => $seasonDescription) {
                $season = new Season();
                $season->setNumber($seasonDescription['number']);
                $season->setYear($seasonDescription['year']);
                $season->setDescription($seasonDescription['description']);
                $season->setPrograms($this->getReference('program_' . $title));
                $manager->persist($season);
                $this->addReference('season_' . $title . '_' . $number, $season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}