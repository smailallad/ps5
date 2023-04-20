<?php

namespace App\Entity;

<<<<<<< HEAD
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
=======
use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
>>>>>>> 38fcca06cc387d979196fcb40902c48b781a6505
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'Image')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $Produit = null;

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

    public function getProducts(): ?Produit
    {
        return $this->Produit;
    }

    public function setProducts(?Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }
<<<<<<< HEAD

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }
=======
>>>>>>> 38fcca06cc387d979196fcb40902c48b781a6505
}
