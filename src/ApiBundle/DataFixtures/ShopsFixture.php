<?php

namespace ApiBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use ApiBundle\Entity\Shop;

class ShopsFixture extends Fixture {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $shopsJsonFile = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR .'shops.json');

        $shopsArray = json_decode($shopsJsonFile, true);

        foreach ($shopsArray as $shop) {

            $shopEntity = new Shop();

            $shopCoordinates = $shop['location']['coordinates'] ;
            $shopLat = $shopCoordinates[0];
            $shopLong = $shopCoordinates[1];

            $shopEntity->setName($shop['name']);
            $shopEntity->setPicture($shop['picture']);
            $shopEntity->setEmail($shop['email']);
            $shopEntity->setCity($shop['city']);
            $shopEntity->setLatitude($shopLat);
            $shopEntity->setLongitude($shopLong);

            $manager->persist($shopEntity);
        }


        $manager->flush();

    }


}