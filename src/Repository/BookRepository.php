<?php

namespace App\Repository;

use App\Entity\Book;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Name;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */

    public function findWithSearch($search)
    {
        $qb = $this->createQueryBuilder('book')
            ->join('book.author', 'author')
            ->join('book.category', 'category')

            // On récupère dans la DB si le title contient notre variable
            ->andWhere('book.title LIKE :title')
            ->setParameter('title', "%{$search->title}%");

        // On verifie que le champ date n'est pas vide
        if (!empty($search->date)) {
            $qb = $qb
                // On récupère dans la DB si le date du book est supérieur ou égal à notre variable
                ->andWhere('book.date >= :date')
                ->setParameter('date', $search->date);
        }

        $qb = $qb
            // On récupère dans la DB si author' contient notre variable
            ->andWhere('author.name LIKE :authorVAL')
            ->setParameter('authorVAL', "%{$search->author}%")

            // On récupère dans la DB si le birthDate de author est supérieur ou égal à notre variable
            ->andWhere('author.birthDate >= :authorDATE')
            ->setParameter('authorDATE', new DateTime($search->authorBirthDate))

            // On récupère dans la DB les books qui ont les categorys séléctionnées
            ->andWhere('category.name IN (:categoryVAL)')
            ->setParameter('categoryVAL', $search->category)

            ->setMaxResults(12);

        return $qb
            ->getQuery()
            ->getResult();
    }
}
