<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Informatiques', null, $manager);
        $this->createCategory('Ordinateur portable', $parent, $manager);
        $this->createCategory('Ecran', $parent, $manager);
        $this->createCategory('Souris', $parent, $manager);

        $parent = $this->createCategory('Mode', null, $manager);
        $this->createCategory('Homme', $parent, $manager);
        $this->createCategory('Femme', $parent, $manager);
        $this->createCategory('Enfant', $parent, $manager);
        $manager->flush();
    }
    private function createCategory(string $name, Categorie $parent = null, ObjectManager $manager)
    {
        $category = new Categorie();
        $category->setNom($name);
        $category->setSlug($this->slugger->slug($category->getNom())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-' . $this->counter, $category);
        $this->counter++;
        return $category;
    }
}
