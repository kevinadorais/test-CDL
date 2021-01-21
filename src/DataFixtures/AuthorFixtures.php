<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // On créer un array authors pour stocker les données qu'on va utiliser pour éviter les répétitions
        $authors = [
            ['J.K.Rowling', '07/31/1965'],
            ['Uderzo', '04/25/1927'],
            ['Masashi Kishimoto', '11/08/1974'],
            ['Guillaume Musso', '06/06/1974']
        ];

        // On boucle sur notre array authors, enregistre nos valeurs et envoie à la base de données
        foreach ($authors as $value) {
            $author = new Author();
            $author
                ->setName($value[0])
                ->setBirthDate(new \DateTime($value[1]));
            $manager->persist($author);
            $manager->flush();
            // On ajoute une reférence pour pouvoir le lier depuis d'autres fixtures
            $this->addReference($value[0], $author);
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
