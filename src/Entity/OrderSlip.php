<?php

namespace App\Entity;

use App\Repository\OrderSlipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderSlipRepository::class)]
class OrderSlip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $total_products_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_products_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_tax_incl;

    #[ORM\Column(type: 'float')]
    private $shipping_cost_amount;

    #[ORM\Column(type: 'float')]
    private $amount;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderSlips')]
    #[ORM\JoinColumn(nullable: false)]
    private $ordered;

    #[ORM\OneToMany(mappedBy: 'orderSlip', targetEntity: OrderSlipDetail::class)]
    private $orderSlipDetails;

    public function __construct()
    {
        $this->orderSlipDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalProductsTaxExcl(): ?float
    {
        return $this->total_products_tax_excl;
    }

    public function setTotalProductsTaxExcl(float $total_products_tax_excl): self
    {
        $this->total_products_tax_excl = $total_products_tax_excl;

        return $this;
    }

    public function getTotalProductsTaxIncl(): ?float
    {
        return $this->total_products_tax_incl;
    }

    public function setTotalProductsTaxIncl(float $total_products_tax_incl): self
    {
        $this->total_products_tax_incl = $total_products_tax_incl;

        return $this;
    }

    public function getTotalShippingTaxExcl(): ?float
    {
        return $this->total_shipping_tax_excl;
    }

    public function setTotalShippingTaxExcl(float $total_shipping_tax_excl): self
    {
        $this->total_shipping_tax_excl = $total_shipping_tax_excl;

        return $this;
    }

    public function getTotalShippingTaxIncl(): ?float
    {
        return $this->total_shipping_tax_incl;
    }

    public function setTotalShippingTaxIncl(float $total_shipping_tax_incl): self
    {
        $this->total_shipping_tax_incl = $total_shipping_tax_incl;

        return $this;
    }

    public function getShippingCostAmount(): ?float
    {
        return $this->shipping_cost_amount;
    }

    public function setShippingCostAmount(float $shipping_cost_amount): self
    {
        $this->shipping_cost_amount = $shipping_cost_amount;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getOrdered(): ?Order
    {
        return $this->ordered;
    }

    public function setOrdered(?Order $ordered): self
    {
        $this->ordered = $ordered;

        return $this;
    }

    /**
     * @return Collection|OrderSlipDetail[]
     */
    public function getOrderSlipDetails(): Collection
    {
        return $this->orderSlipDetails;
    }

    public function addOrderSlipDetail(OrderSlipDetail $orderSlipDetail): self
    {
        if (!$this->orderSlipDetails->contains($orderSlipDetail)) {
            $this->orderSlipDetails[] = $orderSlipDetail;
            $orderSlipDetail->setOrderSlip($this);
        }

        return $this;
    }

    public function removeOrderSlipDetail(OrderSlipDetail $orderSlipDetail): self
    {
        if ($this->orderSlipDetails->removeElement($orderSlipDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderSlipDetail->getOrderSlip() === $this) {
                $orderSlipDetail->setOrderSlip(null);
            }
        }

        return $this;
    }
}
