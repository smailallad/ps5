<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
class Commande
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'Commande')]
    private ?Coupon $Coupon = null;

    #[ORM\ManyToOne(inversedBy: 'Commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'Commande', targetEntity: CommandeDetail::class, orphanRemoval: true)]
    private Collection $CommandeDetail;

    public function __construct()
    {
        $this->CommandeDetail = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCoupons(): ?Coupon
    {
        return $this->Coupon;
    }

    public function setCoupons(?Coupon $Coupon): self
    {
        $this->Coupon = $Coupon;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

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
            $ordersDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrdersDetail(CommandeDetail $ordersDetail): self
    {
        if ($this->CommandeDetail->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getOrders() === $this) {
                $ordersDetail->setOrders(null);
            }
        }

        return $this;
    }
}
