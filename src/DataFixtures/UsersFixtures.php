<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new Users;
        $admin->setEmail('smail@gmail.com')
            ->setFirstname('Smail')
            ->setLastname('ALLAD')
            ->setAddress('Rouiba')
            ->setZipcode('16000')
            ->setCity('Rouiba')
            ->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $user = new Users;
            $user->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setAddress($faker->streetAddress)
                ->setZipcode(str_replace(' ', '', $faker->postcode))
                ->setCity($faker->city)
                ->setPassword($this->passwordEncoder->hashPassword($user, 'secret'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
