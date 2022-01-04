<?php

namespace App\Entity;

use App\Repository\OrderInvoicePaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderInvoicePaymentRepository::class)]
class OrderInvoicePayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderInvoicePayments')]
    private $ordered;

    #[ORM\ManyToOne(targetEntity: OrderInvoice::class, inversedBy: 'orderInvoicePayments')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderInvoice;

    #[ORM\ManyToOne(targetEntity: OrderPayment::class, inversedBy: 'orderInvoicePayments')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderPayment;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOrderInvoice(): ?OrderInvoice
    {
        return $this->orderInvoice;
    }

    public function setOrderInvoice(?OrderInvoice $orderInvoice): self
    {
        $this->orderInvoice = $orderInvoice;

        return $this;
    }

    public function getOrderPayment(): ?OrderPayment
    {
        return $this->orderPayment;
    }

    public function setOrderPayment(?OrderPayment $orderPayment): self
    {
        $this->orderPayment = $orderPayment;

        return $this;
    }
}
