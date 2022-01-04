<?php

namespace App\Entity;

use App\Repository\OrderPaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderPaymentRepository::class)]
class OrderPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $order_reference;

    #[ORM\Column(type: 'float')]
    private $amount;

    #[ORM\Column(type: 'string', length: 255)]
    private $payment_method;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $transaction_id;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\OneToMany(mappedBy: 'orderPayment', targetEntity: OrderInvoicePayment::class)]
    private $orderInvoicePayments;

    public function __construct()
    {
        $this->orderInvoicePayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderReference(): ?string
    {
        return $this->order_reference;
    }

    public function setOrderReference(string $order_reference): self
    {
        $this->order_reference = $order_reference;

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

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getTransactionId(): ?string
    {
        return $this->transaction_id;
    }

    public function setTransactionId(?string $transaction_id): self
    {
        $this->transaction_id = $transaction_id;

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

    /**
     * @return Collection|OrderInvoicePayment[]
     */
    public function getOrderInvoicePayments(): Collection
    {
        return $this->orderInvoicePayments;
    }

    public function addOrderInvoicePayment(OrderInvoicePayment $orderInvoicePayment): self
    {
        if (!$this->orderInvoicePayments->contains($orderInvoicePayment)) {
            $this->orderInvoicePayments[] = $orderInvoicePayment;
            $orderInvoicePayment->setOrderPayment($this);
        }

        return $this;
    }

    public function removeOrderInvoicePayment(OrderInvoicePayment $orderInvoicePayment): self
    {
        if ($this->orderInvoicePayments->removeElement($orderInvoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($orderInvoicePayment->getOrderPayment() === $this) {
                $orderInvoicePayment->setOrderPayment(null);
            }
        }

        return $this;
    }
}
