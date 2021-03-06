<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop
 *
 * @ORM\Table(name="shops")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ShopRepository")
 */
class Shop
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=10)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=10)
     */
    private $longitude;


    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="likedShops")
     */
     private $likedUsers;


    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="disLikedShops")
     */
    private $disLikedUsers;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Shop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Shop
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Shop
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Shop
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Shop
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Shop
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->likedUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->disLikedUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add likedUser
     *
     * @param \ApiBundle\Entity\User $likedUser
     *
     * @return Shop
     */
    public function addLikedUser(\ApiBundle\Entity\User $likedUser)
    {
        $this->likedUsers[] = $likedUser;

        return $this;
    }

    /**
     * Remove likedUser
     *
     * @param \ApiBundle\Entity\User $likedUser
     */
    public function removeLikedUser(\ApiBundle\Entity\User $likedUser)
    {
        $this->likedUsers->removeElement($likedUser);
    }

    /**
     * Get likedUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikedUsers()
    {
        return $this->likedUsers;
    }

    /**
     * Add disLikedUser
     *
     * @param \ApiBundle\Entity\User $disLikedUser
     *
     * @return Shop
     */
    public function addDisLikedUser(\ApiBundle\Entity\User $disLikedUser)
    {
        $this->disLikedUsers[] = $disLikedUser;

        return $this;
    }

    /**
     * Remove disLikedUser
     *
     * @param \ApiBundle\Entity\User $disLikedUser
     */
    public function removeDisLikedUser(\ApiBundle\Entity\User $disLikedUser)
    {
        $this->disLikedUsers->removeElement($disLikedUser);
    }

    /**
     * Get disLikedUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisLikedUsers()
    {
        return $this->disLikedUsers;
    }
}
