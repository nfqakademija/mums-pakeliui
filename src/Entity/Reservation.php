<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trip;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Trip")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $trip;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seats;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $offer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Trip
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * @param Trip $trip
     */
    public function setTrip(Trip $trip)
    {
        $this->trip = $trip;
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


    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getOffer(): ?int
    {
        return $this->offer;
    }

    public function setOffer(int $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(?bool $type): self
    {
        $this->type = $type;

        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    /**
     * @ORM\PrePersist()
     */
    public function setDate()
    {
        $this->date = new \DateTime();
    }
}
