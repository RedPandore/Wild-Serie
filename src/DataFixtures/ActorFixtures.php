<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    const ACTORS = [
        "Édouard Baer",
        "Josiane Balasko",
        "Nicolas Anselme Baptiste",
        "Marc Barbé",
        "Brigitte Bardot",
        "Lily Baron",
        "Jean-Louis Barrault",
        "Marie-Christine Barrault",
        "Gérard Barray",
        "Paul Bartel",
        "Olivier Baroux",
        "Pierre Batcheff",
        "Harry Baur",
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {  
            $actor = new Actor();     
            $actor->setName($actorName);      
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);  
        } 
        $manager->flush();
    }
}
