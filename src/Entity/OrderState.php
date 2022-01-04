<?php

namespace App\Entity;

use App\Repository\OrderStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderStateRepository::class)]
class OrderState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $is_sent_email;

    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    #[ORM\Column(type: 'boolean')]
    private $is_paid;

    #[ORM\Column(type: 'boolean')]
    private $is_pdf_invoice;

    #[ORM\Column(type: 'boolean')]
    private $is_shipped;

    #[ORM\OneToMany(mappedBy: 'orderState', targetEntity: OrderHistory::class)]
    private $orderHistories;

    #[ORM\OneToMany(mappedBy: 'orderState', targetEntity: Order::class)]
    private $orders;

    public function __construct()
    {
        $this->orderHistories = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsSentEmail(): ?bool
    {
        return $this->is_sent_email;
    }

    public function setIsSentEmail(bool $is_sent_email): self
    {
        $this->is_sent_email = $is_sent_email;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->is_paid;
    }

    public function setIsPaid(bool $is_paid): self
    {
        $this->is_paid = $is_paid;

        return $this;
    }

    public function getIsPdfInvoice(): ?bool
    {
        return $this->is_pdf_invoice;
    }

    public function setIsPdfInvoice(bool $Is_pdf_invoice): self
    {
        $this->is_pdf_invoice = $Is_pdf_invoice;

        return $this;
    }

    public function getIsShipped(): ?bool
    {
        return $this->is_shipped;
    }

    public function setIsShipped(bool $is_shipped): self
    {
        $this->is_shipped = $is_shipped;

        return $this;
    }

    /**
     * @return Collection|OrderHistory[]
     */
    public function getOrderHistories(): Collection
    {
        return $this->orderHistories;
    }

    public function addOrderHistory(OrderHistory $orderHistory): self
    {
        if (!$this->orderHistories->contains($orderHistory)) {
            $this->orderHistories[] = $orderHistory;
            $orderHistory->setOrderState($this);
        }

        return $this;
    }

    public function removeOrderHistory(OrderHistory $orderHistory): self
    {
        if ($this->orderHistories->removeElement($orderHistory)) {
            // set the owning side to null (unless already changed)
            if ($orderHistory->getOrderState() === $this) {
                $orderHistory->setOrderState(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setOrderState($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getOrderState() === $this) {
                $order->setOrderState(null);
            }
        }

        return $this;
    }
}
