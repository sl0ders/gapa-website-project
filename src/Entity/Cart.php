<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $delivery_option;

    #[ORM\Column(type: 'text')]
    private $delivery_address;

    #[ORM\Column(type: 'text')]
    private $invoice_address;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $secure_key;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $validate_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: Carrier::class, inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: true)]
    private $carrier;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: true)]
    private $customer;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Order::class)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: CartProduct::class)]
    private $cartProducts;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->cartProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryOption(): ?string
    {
        return $this->delivery_option;
    }

    public function setDeliveryOption(?string $delivery_option): self
    {
        $this->delivery_option = $delivery_option;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): self
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function getInvoiceAddress(): ?string
    {
        return $this->invoice_address;
    }

    public function setInvoiceAddress(string $invoice_address): self
    {
        $this->invoice_address = $invoice_address;

        return $this;
    }

    public function getSecureKey(): ?string
    {
        return $this->secure_key;
    }

    public function setSecureKey(string $secure_key): self
    {
        $this->secure_key = $secure_key;

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

    public function getValidateAt(): ?\DateTimeInterface
    {
        return $this->validate_at;
    }

    public function setValidateAt(?\DateTimeInterface $validate_at): self
    {
        $this->validate_at = $validate_at;

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

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

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
            $order->setCart($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCart() === $this) {
                $order->setCart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CartProduct[]
     */
    public function getCartProducts(): Collection
    {
        return $this->cartProducts;
    }

    public function addCartProduct(CartProduct $cartProduct): self
    {
        if (!$this->cartProducts->contains($cartProduct)) {
            $this->cartProducts[] = $cartProduct;
            $cartProduct->setCart($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProducts->removeElement($cartProduct)) {
            // set the owning side to null (unless already changed)
            if ($cartProduct->getCart() === $this) {
                $cartProduct->setCart(null);
            }
        }

        return $this;
    }
}
