<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\OneToMany(mappedBy: 'delivery', targetEntity: Order::class)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'delivery', targetEntity: Carrier::class)]
    private $carrier;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->carrier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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
            $order->setDelivery($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getDelivery() === $this) {
                $order->setDelivery(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Carrier[]
     */
    public function getCarrier(): Collection
    {
        return $this->carrier;
    }

    public function addCarrier(Carrier $carrier): self
    {
        if (!$this->carrier->contains($carrier)) {
            $this->carrier[] = $carrier;
            $carrier->setDelivery($this);
        }

        return $this;
    }

    public function removeCarrier(Carrier $carrier): self
    {
        if ($this->carrier->removeElement($carrier)) {
            // set the owning side to null (unless already changed)
            if ($carrier->getDelivery() === $this) {
                $carrier->setDelivery(null);
            }
        }

        return $this;
    }
}
