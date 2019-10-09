<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder= $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $users = [];
        $genres = ['male', 'female']; 

        $faker = Factory::create('FR_fr');

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $genre = $faker->randomElement($genres); 
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1,99) . '.jpg';
            
            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId;

            $password = $this->encoder->encodePassword($user, 'password'); 

            $user->setFirstname($faker->firstname($genre))
                ->setEmail($faker->email)
                ->setPassword($password)
                ->setPicture($picture);
            $manager->persist($user);
        }
        $manager->flush();
        $users[] = $user;
    }
}




   
    