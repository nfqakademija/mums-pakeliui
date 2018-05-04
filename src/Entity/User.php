<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\OneToMany(targetEntity="Trip", mappedBy="user")
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebookId;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebookAccessToken;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $googleId;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $googleAccessToken;

    public function setFacebookId($facebookID)
    {
        $this->facebookId = $facebookID;

        return $this;
    }

    public function getFacebookId()
    {
        return $this->facebookId;
    }

    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getGoogleId()
    {
        return $this->googleId;
    }

    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    public function getGoogleAccessToken()
    {
        return $this->googleAccessToken;
    }
}
