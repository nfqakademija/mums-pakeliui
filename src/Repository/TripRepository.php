<?php

namespace App\Repository;

use App\Entity\Trip;
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
            ->Where('t.departTime >= :today')
            ->setParameter('today', new \DateTime())
            ->orderBy('t.departTime', 'desc');

        if (isset($value['departFrom'])) {
            $trips->andWhere('t.departFrom LIKE :departFrom')
                ->setParameter('departFrom', '%'.$value['departFrom'].'%');
        }

        if (isset($value['destination'])) {
            $trips->andWhere('t.destination LIKE :destination')
                ->setParameter('destination', '%'.$value['destination'].'%');
        }

        if (isset($value['travelerType'])) {
            $trips->andWhere('t.travelerType = :travelerType')
                ->setParameter('travelerType', $value['travelerType']);
        }

        if (isset($value['smoke'])) {
            $trips->andWhere('t.smoke = :smoke')
                ->setParameter('smoke', $value['smoke']);
        }

        if (isset($value['pets'])) {
            $trips->andWhere('t.pets = :pets')
                ->setParameter('pets', $value['pets']);
        }
        if (isset($value['departDate'])) {
            $departDate = $value['departDate']->format('Y-m-d H:i');
            $start = new \DateTime(sprintf('%s', $departDate));
            $end = new \DateTime(sprintf('%s', $departDate));
            $timeFrom = $start->modify('+'.$value['timeFrom'].' hour');
            $timeTo = $end->modify('+'.$value['timeTo'].' hour');
            $trips->andWhere('t.departTime BETWEEN :startDepartTime AND :endDepartTime')
                ->setParameter('startDepartTime', $timeFrom)
                ->setParameter('endDepartTime', $timeTo);
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

    public function findTripByUserAndDate($user, $date)
    {
        $departDate = $date->format('Y-m-d');
        $tripId = $this->createQueryBuilder("t")
            ->select("t.id")
            ->Where('t.departTime LIKE :departTime')
            ->andWhere('t.user = :user')
            ->setParameter('departTime', $departDate.'%')
            ->setParameter('user', $user)
            ->setMaxResults(1);

        return $tripId
            ->getQuery()
            ->getResult();
    }

    public function createTripQueryBuilder($value)
    {
        return $this->createQueryBuilder('t')
            ->Where('t.departTime >= :today')
            ->andWhere('t.user = :user')
            ->setParameter('today', new \DateTime())
            ->setParameter('user', $value);
    }
}
