<?php

namespace App\Entity;

use App\Repository\CouponTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponTypeRepository::class)]
class CouponType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'coupon_type', targetEntity: Coupon::class, orphanRemoval: true)]
    private Collection $Coupon;

    public function __construct()
    {
        $this->Coupon = new ArrayCollection();
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

    /**
     * @return Collection<int, Coupon>
     */
    public function getCoupon(): Collection
    {
        return $this->Coupon;
    }

    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->Coupon->contains($coupon)) {
            $this->Coupon->add($coupon);
            $coupon->setCouponType($this);
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self
    {
        if ($this->Coupon->removeElement($coupon)) {
            // set the owning side to null (unless already changed)
            if ($coupon->getCouponType() === $this) {
                $coupon->setCouponType(null);
            }
        }

        return $this;
    }
}
