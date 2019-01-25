<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{

    public function getFilter($filter)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->innerJoin('b.publisher', 'p')
            ->innerJoin('b.authors', 'a')
            ->where('b.bookName LIKE :filter OR b.publishingDate LIKE :filter OR
                b.pages LIKE :filter OR b.edition LIKE :filter OR b.category LIKE :filter OR
                p.publisherName LIKE :filter or a.AuthorName LIKE :filter ')
            ->setParameter('filter', '%' . $filter . '%');

        return $qb->getQuery()->getResult();

    }
}
