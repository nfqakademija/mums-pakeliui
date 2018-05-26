<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Reservation;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 */
class Trip
{
    const TYPE_PASSENGER = 1;
    const TYPE_DRIVER = 0;
    const ACCEPT = 1;
    const NOT_ACCEPT = 0;
    /**
     * @ORM\Id()
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="trip")
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $departFrom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departTime;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $travelerType;

    /**
     * @ORM\Column(type="integer")
     */
    private $seats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $smoke;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pets;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $information;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getDepartFrom()
    {
        return $this->departFrom;
    }

    /**
     * @param mixed $departFrom
     */
    public function setDepartFrom($departFrom): void
    {
        $this->departFrom = $departFrom;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination): void
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getDepartTime()
    {
        return $this->departTime;
    }

    /**
     * @param mixed $departTime
     */
    public function setDepartTime($departTime): void
    {
        $this->departTime = $departTime;
    }

    /**
     * @return mixed
     */
    public function getTravelerType()
    {
        return $this->travelerType;
    }

    /**
     * @param mixed $travelerType
     */
    public function setTravelerType($travelerType): void
    {
        $this->travelerType = $travelerType;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return mixed
     */
    public function getSmoke()
    {
        return $this->smoke;
    }

    /**
     * @param mixed $smoke
     */
    public function setSmoke($smoke): void
    {
        $this->smoke = $smoke;
    }

    /**
     * @return mixed
     */
    public function getPets()
    {
        return $this->pets;
    }

    /**
     * @param mixed $pets
     */
    public function setPets($pets): void
    {
        $this->pets = $pets;
    }

    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param mixed $information
     */
    public function setInformation($information): void
    {
        $this->information = $information;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
