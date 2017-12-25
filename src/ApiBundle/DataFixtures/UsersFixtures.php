<?php
namespace ApiBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use ApiBundle\Entity\User;

class UsersFixtures extends Fixture {

    private $encoder;


    /**
     * UsersFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user =  new User();

        $user->setUsername('user1');
        $user->setEmail('user1@email.com');
        $user->setPlainPassword('pass123');
        $user->setEnabled(1);
        $user->addRole('ROLE_USER');


        $manager->persist($user);
        $manager->flush();

    }


}


