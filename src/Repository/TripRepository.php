<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository
{
    const MAX_PER_PAGE = 12;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trip::class);
    }
    /**
     * @param int $page
     * @param int $maxPerPage
     * @throws NotFoundHttpException
     * @return Paginator
     */

    public function findBySomeField($page, $value, $maxPerPage = self::MAX_PER_PAGE)
    {
        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'Turi būti skaičius: ' . $page . '.'
            );
        }

        if ($page < 1) {
            throw new NotFoundHttpException('Puslapis neegzistuoja');
        }

        $trips = $this->createQueryBuilder('t')
            ->leftJoin("App\Entity\User", "u", "WITH", "u.id = t.user")
            ->Where('t.departTime >= :today')
            ->setParameter('today', new \DateTime())
            ->orderBy('t.departTime', 'asc');

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
        $trips
            ->getQuery();
        $firstResultat = ($page - 1) * $maxPerPage;
        $trips->setFirstResult($firstResultat)->setMaxResults($maxPerPage);
        $paginator = new Paginator($trips);

        if (($paginator->count() <= $firstResultat) && $page != 1) {
            throw new NotFoundHttpException('Puslapis neegzistuoja.'); // page 404
        }

        return $paginator;
    }

    /**
     * @return Trip[]
     */
    public function findByUser($value)
    {
        $trips = $this->createQueryBuilder('t')
            ->Where('t.departTime >= :today')
            ->andWhere('t.user = :user')
            ->orderBy('t.departTime', 'ASC')
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

    /**
     * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
     */
    public function findOneByUserAndDate($user, $date)
    {
        $departDate = $date->format('Y-m-d');
        $tripId = $this->createQueryBuilder("t")
            ->Where('t.departTime LIKE :departTime')
            ->andWhere('t.user = :user')
            ->setParameter('departTime', $departDate.'%')
            ->setParameter('user', $user);

        return $tripId->getQuery()->getOneOrNullResult();
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
