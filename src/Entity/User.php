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
     * @ORM\OneToMany(targetEntity="Entity\Trip", mappedBy="uId")
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    public function setFacebookId($facebookID) {
        $this->facebook_id = $facebookID;

        return $this;
    }

    public function getFacebookId() {
        return $this->facebook_id;
    }

    public function setFacebookAccessToken($facebookAccessToken) {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    public function getFacebookAccessToken() {
        return $this->facebook_access_token;
    }

    public function setGoogleId($googleId) {
        $this->google_id = $googleId;

        return $this;
    }

    public function getGoogleId() {
        return $this->google_id;
    }

    public function setGoogleAccessToken($googleAccessToken) {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    public function getGoogleAccessToken() {
        return $this->google_access_token;
    }
}
