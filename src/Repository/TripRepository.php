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

        if (isset($value['departFrom'])) {
            $trips->andWhere('t.departFrom = :departFrom')
                ->setParameter('departFrom', $value['departFrom']);
        }

        if (isset($value['destination'])) {
            $trips->andWhere('t.destination = :destination')
                ->setParameter('destination', $value['destination']);
        }

        if (isset($value['travelerType'])) {
            $trips->andWhere('t.travelerType = :travelerType')
                ->setParameter('travelerType', $value['travelerType']);
        }

        if ($value['smoke']) {
            $trips->andWhere('t.smoke = :smoke')
                ->setParameter('smoke', $value['smoke']);
        }

        if ($value['pets']) {
            $trips->andWhere('t.pets = :pets')
                ->setParameter('pets', $value['pets']);
        }

        if (isset($value['departDate']) && !$value['departTime']) {
            $departDate = $value['departDate']->format('Y-m-d');
            $trips->andWhere('t.departTime LIKE :departTime')
                ->setParameter('departTime', $departDate.'%');
        }

        if (!$value['departDate'] && isset($value['departTime'])) {
            $date = date("Y-m-d");
            $startDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
            $endDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
            $endDate = $endDate->modify('+1 hour');
            $trips->andWhere('t.departTime BETWEEN :startDepartTime AND :endDepartTime')
                ->setParameter('startDepartTime', $startDate)
                ->setParameter('endDepartTime', $endDate);
        }

        if (isset($value['departDate']) && isset($value['departTime'])) {
            $date =  $value['departDate']->format('Y-m-d');
            $startDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
            $endDate = new \DateTime(sprintf('%s %s', $date, $value['departTime']->format('H:i')));
            $endDate = $endDate->modify('+1 hour');
            $trips->andWhere('t.departTime BETWEEN :startDepartTime AND :endDepartTime')
                ->setParameter('startDepartTime', $startDate)
                ->setParameter('endDepartTime', $endDate);
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
