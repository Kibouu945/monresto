<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {

        $this->encoder = $encoder;
    }



    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = new User();
        $admin ->setEmail('rokibtadjou@gmail.com');
        $admin ->setRoles (array('ROLE_ADMIN'));
        $admin ->setPassword($this -> encoder -> encodePassword($admin , 'motdepasse'));
        $admin ->setNom('TADJOU');
        $admin ->setPrenoms('Rokib');
        $admin ->setType('');
        $manager->persist($admin);
        $manager->flush();
    }
}
