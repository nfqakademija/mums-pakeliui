<?php

namespace App\Repository;

use App\Entity\Trip;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Repository\UserRepository;

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
            ->leftJoin("App\Entity\User", "u", "WITH", "u.id = t.user")
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
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Trip[]
     */
    public function findByUser($value)
    {
        $trips = $this->createQueryBuilder('t')
                      ->Where('t.departTime >= :today')
                      ->andWhere('t.user = :user')
                      ->orderBy('t.id', 'ASC')
                      ->setParameter('today', new \DateTime())
                      ->setParameter('user', $value);

        return $trips
            ->getQuery()
            ->getResult();
    }
}
