<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'float')]
    private $total_price_ht;

    #[ORM\Column(type: 'float')]
    private $total_price_ttc;

    #[ORM\Column(type: 'text')]
    private $address_delivery;

    #[ORM\Column(type: 'text')]
    private $address_invoice;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: OrderState::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $orderState;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'orders')]
    private $products;

    #[ORM\ManyToOne(targetEntity: OrderHistory::class, inversedBy: 'orders')]
    private $orderHistory;

    #[ORM\OneToMany(mappedBy: 'ordered', targetEntity: OrderSlip::class)]
    private $orderSlips;

    #[ORM\OneToOne(mappedBy: 'ordered', targetEntity: OrderDetail::class, cascade: ['persist', 'remove'])]
    private $orderDetail;

    #[ORM\OneToMany(mappedBy: 'ordered', targetEntity: OrderReturn::class)]
    private $orderReturns;

    #[ORM\OneToMany(mappedBy: 'ordered', targetEntity: OrderInvoice::class)]
    private $orderInvoices;

    #[ORM\OneToMany(mappedBy: 'ordered', targetEntity: OrderInvoicePayment::class)]
    private $orderInvoicePayments;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->orderSlips = new ArrayCollection();
        $this->orderReturns = new ArrayCollection();
        $this->orderInvoices = new ArrayCollection();
        $this->orderInvoicePayments = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTotalPriceHt(): ?float
    {
        return $this->total_price_ht;
    }

    public function setTotalPriceHt(float $total_price_ht): self
    {
        $this->total_price_ht = $total_price_ht;

        return $this;
    }

    public function getTotalPriceTtc(): ?float
    {
        return $this->total_price_ttc;
    }

    public function setTotalPriceTtc(float $total_price_ttc): self
    {
        $this->total_price_ttc = $total_price_ttc;

        return $this;
    }

    public function getAddressDelivery(): ?string
    {
        return $this->address_delivery;
    }

    public function setAddressDelivery(string $address_delivery): self
    {
        $this->address_delivery = $address_delivery;

        return $this;
    }

    public function getAddressInvoice(): ?string
    {
        return $this->address_invoice;
    }

    public function setAddressInvoice(string $address_invoice): self
    {
        $this->address_invoice = $address_invoice;

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

    public function getOrderState(): ?OrderState
    {
        return $this->orderState;
    }

    public function setOrderState(?OrderState $orderState): self
    {
        $this->orderState = $orderState;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getOrderHistory(): ?OrderHistory
    {
        return $this->orderHistory;
    }

    public function setOrderHistory(?OrderHistory $orderHistory): self
    {
        $this->orderHistory = $orderHistory;

        return $this;
    }

    /**
     * @return Collection|OrderSlip[]
     */
    public function getOrderSlips(): Collection
    {
        return $this->orderSlips;
    }

    public function addOrderSlip(OrderSlip $orderSlip): self
    {
        if (!$this->orderSlips->contains($orderSlip)) {
            $this->orderSlips[] = $orderSlip;
            $orderSlip->setOrdered($this);
        }

        return $this;
    }

    public function removeOrderSlip(OrderSlip $orderSlip): self
    {
        if ($this->orderSlips->removeElement($orderSlip)) {
            // set the owning side to null (unless already changed)
            if ($orderSlip->getOrdered() === $this) {
                $orderSlip->setOrdered(null);
            }
        }

        return $this;
    }

    public function getOrderDetail(): ?OrderDetail
    {
        return $this->orderDetail;
    }

    public function setOrderDetail(OrderDetail $orderDetail): self
    {
        // set the owning side of the relation if necessary
        if ($orderDetail->getOrdered() !== $this) {
            $orderDetail->setOrdered($this);
        }

        $this->orderDetail = $orderDetail;

        return $this;
    }

    /**
     * @return Collection|OrderReturn[]
     */
    public function getOrderReturns(): Collection
    {
        return $this->orderReturns;
    }

    public function addOrderReturn(OrderReturn $orderReturn): self
    {
        if (!$this->orderReturns->contains($orderReturn)) {
            $this->orderReturns[] = $orderReturn;
            $orderReturn->setOrdered($this);
        }

        return $this;
    }

    public function removeOrderReturn(OrderReturn $orderReturn): self
    {
        if ($this->orderReturns->removeElement($orderReturn)) {
            // set the owning side to null (unless already changed)
            if ($orderReturn->getOrdered() === $this) {
                $orderReturn->setOrdered(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderInvoice[]
     */
    public function getOrderInvoices(): Collection
    {
        return $this->orderInvoices;
    }

    public function addOrderInvoice(OrderInvoice $orderInvoice): self
    {
        if (!$this->orderInvoices->contains($orderInvoice)) {
            $this->orderInvoices[] = $orderInvoice;
            $orderInvoice->setOrdered($this);
        }

        return $this;
    }

    public function removeOrderInvoice(OrderInvoice $orderInvoice): self
    {
        if ($this->orderInvoices->removeElement($orderInvoice)) {
            // set the owning side to null (unless already changed)
            if ($orderInvoice->getOrdered() === $this) {
                $orderInvoice->setOrdered(null);
            }
        }

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
            $orderInvoicePayment->setOrdered($this);
        }

        return $this;
    }

    public function removeOrderInvoicePayment(OrderInvoicePayment $orderInvoicePayment): self
    {
        if ($this->orderInvoicePayments->removeElement($orderInvoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($orderInvoicePayment->getOrdered() === $this) {
                $orderInvoicePayment->setOrdered(null);
            }
        }

        return $this;
    }
}
