<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // On créer un array books pour stocker les données qu'on va utiliser pour éviter les répétitions
        // On ajoute des champs null pour combler les trous.
        $books = [
            ["Harry Potter à l'école des sorciers", "1997", "J.K.Rowling", "Roman"],
            ["Harry Potter et la Chambre des secrets", "1998", "J.K.Rowling", "BD"],
            ["Harry Potter et le Prisonnier d'Azkaban", "1999", "J.K.Rowling", "Roman"],
            ["Astérix le Gaulois", "1961", "Uderzo", "BD"],
            ["La Serpe d'or", null, "Uderzo", "BD"],
            ["Le fils d'Astérix", null, null, "BD"],
            ["One-Punch Man", null, null, "Manga"],
            ["Naruto - Tome 1", "1995", "Masashi Kishimoto", "Manga"],
            ["La Jeune Fille et la nuit", "1918", "Guillaume Musso", "Roman"]
        ];

        // On boucle sur notre array books, enregistre nos valeurs et envoie à la base de données
        foreach ($books as $value) {
            $book = new Book();
            $book->setTitle($value[0]);

            // Si le champ est différent de null je l'enregistre
            // Et on récupère les références pour lier les books aux authors et aux categorys
            if ($value[1] != null) {
                $book->setDate($value[1]);
            };
            if ($value[2] != null) {
                $book->setAuthor($this->getReference($value[2]));
            };
            $book->setCategory($this->getReference($value[3]));

            $manager->persist($book);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 2;
    }
}
