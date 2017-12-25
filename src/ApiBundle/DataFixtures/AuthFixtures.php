<?php
namespace ApiBundle\DataFixtures;

use ApiBundle\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthFixtures extends Fixture {


    /**
     * UsersFixtures constructor.
     */
    public function __construct(){

    }

    public function load(ObjectManager $manager)
    {

        $client =  new Client();

        $client->setRedirectUris(['localhost']);
        $client->setAllowedGrantTypes(['password', 'token']);
        $client->setRandomId('3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4');
        $client->setSecret('4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k');

        $manager->persist($client);
        $manager->flush();

    }


}


