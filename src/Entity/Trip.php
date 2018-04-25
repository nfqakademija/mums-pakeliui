<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 */
class Trip
{
    public const NUM_ITEMS = 10;
    /**
     * @ORM\Id()
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
     * @ORM\Column(type="string")
     */
    private $information;


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

    public function getId()
    {
        return $this->id;
    }

}
