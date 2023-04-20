<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\SlugTrait;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Produit
{
    use CreatedAtTrait;
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'Produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categirie = null;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $Image;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: CommandeDetail::class)]
    private Collection $CommandeDetail;

    public function __construct()
    {
        $this->Image = new ArrayCollection();
        $this->CommandeDetail = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategiries(): ?Categorie
    {
        return $this->categirie;
    }

    public function setCategiries(?Categorie $categiries): self
    {
        $this->categirie = $categiries;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->Image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->Image->contains($image)) {
            $this->Image->add($image);
            $image->setProducts($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->Image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProducts() === $this) {
                $image->setProducts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeDetail>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->CommandeDetail;
    }

    public function addOrdersDetail(CommandeDetail $ordersDetail): self
    {
        if (!$this->CommandeDetail->contains($ordersDetail)) {
            $this->CommandeDetail->add($ordersDetail);
            $ordersDetail->setProducts($this);
        }

        return $this;
    }

    public function removeOrdersDetail(CommandeDetail $ordersDetail): self
    {
        if ($this->CommandeDetail->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getProducts() === $this) {
                $ordersDetail->setProducts(null);
            }
        }

        return $this;
    }

    public function getCategirie(): ?Categorie
    {
        return $this->categirie;
    }

    public function setCategirie(?Categorie $categirie): self
    {
        $this->categirie = $categirie;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImage(): Collection
    {
        return $this->Image;
    }

    /**
     * @return Collection<int, CommandeDetail>
     */
    public function getCommandeDetail(): Collection
    {
        return $this->CommandeDetail;
    }

    public function addCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if (!$this->CommandeDetail->contains($commandeDetail)) {
            $this->CommandeDetail->add($commandeDetail);
            $commandeDetail->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if ($this->CommandeDetail->removeElement($commandeDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetail->getProduit() === $this) {
                $commandeDetail->setProduit(null);
            }
        }

        return $this;
    }
}
