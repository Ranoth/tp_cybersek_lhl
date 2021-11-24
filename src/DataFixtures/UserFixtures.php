<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
            ->setUsername('admin')
            ->setRoles($this->roles = array('ROLE_ADMIN'));
        
        $manager->persist($user);
        $manager->flush();
    }
}
