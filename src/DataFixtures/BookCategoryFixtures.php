<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // On créer un array categorys pour stocker les données qu'on va utiliser pour éviter les répétitions
        $categorys = ['Roman', 'BD', 'Manga'];

        // On boucle sur notre array categorys, enregistre nos valeurs et envoie à la base de données
        foreach ($categorys as $value) {
            $bookCategory = new BookCategory();
            $bookCategory
                ->setName($value);
            $manager->persist($bookCategory);
            $manager->flush();
            // On ajoute une reférence pour pouvoir le lier depuis d'autres fixtures
            $this->addReference($value, $bookCategory);
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
