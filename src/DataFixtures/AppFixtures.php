<?php

namespace App\DataFixtures;

use App\Entity\HomePage;
use App\Entity\Module;
use App\Entity\Seo;
use App\Entity\Template;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface $encoder
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin = new User();

        $admin->setFirstName("Admin")
            ->setLastName("Istrateur")
            ->setEmail("admin@admin.fr")
            ->setUsername("admin")
            ->setRoles([User::ADMIN])
            ->setPassword($this->encoder->encodePassword($admin, "admin"))
        ;
    
        $manager->persist($admin);

        $manager->flush();
    }
}
