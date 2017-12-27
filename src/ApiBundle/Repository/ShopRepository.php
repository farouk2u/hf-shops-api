<?php

namespace ApiBundle\Repository;

/**
 * ShopRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ShopRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Get All Shops Order by Distance Nears first
     * @param $latitude
     * @param $longitude
     * @return array
     */
    public function findAllOrderedByDistance($latitude, $longitude){

        // Quick Excep Handling
        if(!$latitude || !$longitude) {

            return $this->findAll();
        }

        $query= $this->createQueryBuilder('s')
            ->select('s')
            ->addSelect(
                '( 3959 * acos(cos(radians(' . $latitude . '))' .
                '* cos( radians( s.latitude ) )' .
                '* cos( radians( s.longitude )' .
                '- radians(' . $longitude . ') )' .
                '+ sin( radians(' . $latitude . ') )' .
                '* sin( radians( s.latitude ) ) ) ) as distance'
            )
            ->orderBy('distance', 'ASC')
            ->getQuery();



        return $query->getResult();

    }
}
