<?php

namespace App\Entity;

use App\Repository\OrderReturnDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderReturnDetailRepository::class)]
class OrderReturnDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantityProduct;

    #[ORM\ManyToOne(targetEntity: OrderDetail::class, inversedBy: 'orderReturnDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderDetail;

    #[ORM\ManyToOne(targetEntity: OrderReturn::class, inversedBy: 'orderReturnDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderReturn;

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

    public function getOrderDetail(): ?OrderDetail
    {
        return $this->orderDetail;
    }

    public function setOrderDetail(?OrderDetail $orderDetail): self
    {
        $this->orderDetail = $orderDetail;

        return $this;
    }

    public function getOrderReturn(): ?OrderReturn
    {
        return $this->orderReturn;
    }

    public function setOrderReturn(?OrderReturn $orderReturn): self
    {
        $this->orderReturn = $orderReturn;

        return $this;
    }
}
