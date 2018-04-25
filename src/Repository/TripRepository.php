<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trip::class);
    }

      /**
       * @return Trip[] Returns an array of Trip objects
        */

    public function findBySomeField($value)
    {
        $trips = $this->createQueryBuilder('t')
            ->orderBy('t.departTime', 'desc');

        foreach ($value as $key => $val) {
            if ($value[$key] or $value[$key] === 0) {
                if ($key === 'departDate' or $key === 'departTime') {
                    if (($value['departDate'] && !$value['departTime'])) {
                        $departDate = $value['departDate']->format('Y-m-d');
                        $trips->andWhere('t.departTime LIKE :departTime')
                        ->setParameter('departTime', $departDate.'%');
                    } else {
                        if ($value['departDate']) {
                            $date = $value['departDate']->format('Y-m-d');
                        } else {
                            $date = date("Y-m-d");
                        }
                          $startDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
                          $endDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
                          $endDate = $endDate->modify('+1 hour');
                          $trips->andWhere('t.departTime BETWEEN :startDepartTime AND :endDepartTime')
                              ->setParameter('startDepartTime', $startDate)
                              ->setParameter('endDepartTime', $endDate)
                          ;
                    }
                } else {
                    $trips->andWhere('t.' . $key . ' = :' . $key)
                        ->setParameter($key, $value[$key]);
                }
            }
        }


        return $trips
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Trip
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
