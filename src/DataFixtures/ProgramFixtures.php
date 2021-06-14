<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Dragon Ball Z' => [
            'summary' => "Cinq ans après le mariage de Son Gokû, Raditz, un mystérieux guerrier de l'espace, arrive sur Terre. Il apprend à Son Gôku qu'il ne reste plus que quatre survivant sur leur planète et que ce dernier avait été envoyé sur terre pour la détruire",
            'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/18/09/24/11/16/5831346.jpg',
            'country' => 'Japon',
            'year' => '1996',
            'category' => 'Animation'
        ],
        'Dexter' => [
            'summary' => "Brillant expert scientifique du service médico-légal de la police de Miami, Dexter Morgan est spécialisé dans l'analyse de prélèvements sanguins. Mais voilà, Dexter cache un terrible secret : il est également tueur en série. Un serial killer pas comme les autres, avec sa propre vision de la justice.",
            'poster' => 'https://fr.web.img6.acsta.net/c_310_420/pictures/210/032/21003280_20130504002100017.jpg',
            'country' => 'USA',
            'year' => '2006',
            'category' => 'Action',
        ],
        'Peakey Blinders' => [
            'summary' => "En 1919, à Birmingham, soldats, révolutionnaires politiques et criminels combattent pour se faire une place dans le paysage industriel de l'après-Guerre. Le Parlement s'attend à une violente révolte, et Winston Churchill mobilise des forces spéciales pour contenir les menaces",
            'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/210/457/21045721_20131001172258551.jpg',
            'country' => 'Grand Bretagne',
            'year' => '2013',
            'category' => 'Aventure',
        ],
        'Breaking bad' => [
            'summary' => "Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. ",
            'poster' => 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/06/18/12/11/3956503.jpg',
            'country' => 'USA',
            'year' => '2008',
            'category' => 'Action',
        ],
        'Hunter X Hunter' => [
            'summary' => "Le jeune Gon vit sur une petite île avec sa tante. Abandonné par son père qui est un Hunter, à la fois un aventurier et un chasseur de primes, Gon décide à l'âge de 12 ans de partir pour devenir un Hunter. ",
            'poster' => 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/08/01/09/52/4803203.jpg',
            'country' => 'Japon',
            'year' => '2011',
            'category' => 'Animation',
        ],
    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }


    public function load(ObjectManager $manager)
    {

        foreach(self::PROGRAMS as $title => $content) {
        $program = new Program();
        $program->setTitle($title);
        $program->setSummary($content['summary']);
        $program->setPoster($content['poster']);
        $program->setCountry($content['country']);
        $program->setYear($content['year']);
        $program->setCategory($this->getReference('category_0'));
        for($i=0; $i > count(ActorFixtures::ACTORS); $i++) {
            $program->addActor(($this->getReference('actor_' . $i)));
        }

        $program->setSlug($this->slugify->generate($program->getTitle()));

        $manager->persist($program);
        $this->addReference('program_' . $title, $program);
    }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }
}
