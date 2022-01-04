<?php

namespace App\Entity;

use App\Repository\OrderSlipDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderSlipDetailRepository::class)]
class OrderSlipDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantityProduct;

    #[ORM\ManyToOne(targetEntity: OrderSlip::class, inversedBy: 'orderSlipDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderSlip;

    #[ORM\ManyToOne(targetEntity: OrderDetail::class, inversedBy: 'orderSlipDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderDetail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantityProduct(): ?int
    {
        return $this->quantityProduct;
    }

    public function setQuantityProduct(int $quantityProduct): self
    {
        $this->quantityProduct = $quantityProduct;

        return $this;
    }

    public function getOrderSlip(): ?OrderSlip
    {
        return $this->orderSlip;
    }

    public function setOrderSlip(?OrderSlip $orderSlip): self
    {
        $this->orderSlip = $orderSlip;

        return $this;
    }

    public function getOrderDetail(): ?OrderDetail
    {
        return $this->orderDetail;
    }

    public function setOrderDetail(?OrderDetail $orderDetail): self
    {
        $this->orderDetail = $orderDetail;

        return $this;
    }
}
