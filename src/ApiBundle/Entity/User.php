<?php

namespace ApiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Shop", inversedBy="likedUsers")
     * @ORM\JoinTable(name="users_like_shops")
     */
     private $likedShops;



    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Shop", inversedBy="disLikedUsers")
     * @ORM\JoinTable(name="users_dislike_shops")
     */
     private $disLikedShops;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add likedShop
     *
     * @param \ApiBundle\Entity\Shop $likedShop
     *
     * @return User
     */
    public function addLikedShop(\ApiBundle\Entity\Shop $likedShop)
    {
        $this->likedShops[] = $likedShop;

        return $this;
    }

    /**
     * Remove likedShop
     *
     * @param \ApiBundle\Entity\Shop $likedShop
     */
    public function removeLikedShop(\ApiBundle\Entity\Shop $likedShop)
    {
        $this->likedShops->removeElement($likedShop);
    }

    /**
     * Get likedShops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikedShops()
    {
        return $this->likedShops;
    }

    /**
     * Add disLikedShop
     *
     * @param \ApiBundle\Entity\Shop $disLikedShop
     *
     * @return User
     */
    public function addDisLikedShop(\ApiBundle\Entity\Shop $disLikedShop)
    {
        $this->disLikedShops[] = $disLikedShop;

        return $this;
    }

    /**
     * Remove disLikedShop
     *
     * @param \ApiBundle\Entity\Shop $disLikedShop
     */
    public function removeDisLikedShop(\ApiBundle\Entity\Shop $disLikedShop)
    {
        $this->disLikedShops->removeElement($disLikedShop);
    }

    /**
     * Get disLikedShops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDisLikedShops()
    {
        return $this->disLikedShops;
    }
}
