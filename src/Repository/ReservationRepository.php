<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reservation::class);
    }
    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function findByUserJoinedTrip($value)
    {
        $reservations = $this->createQueryBuilder('r')
                             ->orderBy('r.trip', 'ASC')
                             ->leftJoin("App\Entity\User", "u", "WITH", "u.id = r.user")
                             ->leftJoin("App\Entity\Trip", "t", "WITH", "t.id = r.trip")
                             ->Where('t.departTime >= :today')
                             ->andWhere('t.user = :user')
                             ->setParameter('today', new \DateTime())
                             ->setParameter('user', $value)
                             ;

        return $reservations
           ->getQuery()
           ->getResult();
    }
}
