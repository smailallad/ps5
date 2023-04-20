<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class CommandeDetail
{
    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'CommandeDetail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $Commande = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'CommandeDetail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $Produit = null;

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getOrders(): ?Commande
    {
        return $this->Commande;
    }

    public function setOrders(?Commande $Commande): self
    {
        $this->Commande = $Commande;

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

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): self
    {
        $this->Commande = $Commande;

        return $this;
    }

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
