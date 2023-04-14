<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'Categorie')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $Categorie;

    #[ORM\OneToMany(mappedBy: 'categiries', targetEntity: Produit::class)]
    private Collection $Produit;

    public function __construct()
    {
        $this->Categorie = new ArrayCollection();
        $this->Produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->Categorie;
    }

    public function addCategory(self $category): self
    {
        if (!$this->Categorie->contains($category)) {
            $this->Categorie->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->Categorie->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProducts(): Collection
    {
        return $this->Produit;
    }

    public function addProduct(Produit $product): self
    {
        if (!$this->Produit->contains($product)) {
            $this->Produit->add($product);
            $product->setCategiries($this);
        }

        return $this;
    }

    public function removeProduct(Produit $product): self
    {
        if ($this->Produit->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategiries() === $this) {
                $product->setCategiries(null);
            }
        }

        return $this;
    }
}
