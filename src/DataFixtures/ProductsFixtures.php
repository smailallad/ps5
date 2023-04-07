<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductsFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $product = new Products();
            $product->setName($faker->text(15))
                ->setDescription($faker->text())
                ->setSlug($this->slugger->slug($product->getName())->lower())
                ->setPrice($faker->numberBetween(900, 150000))
                ->setStock($faker->numberBetween(0, 10));

            $category = $this->getReference('cat-' . rand(1, 8));
            $product->setCategiries($category);

            $this->setReference('prod-' . $i, $product);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
