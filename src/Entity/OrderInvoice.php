<?php

namespace App\Entity;

use App\Repository\OrderInvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderInvoiceRepository::class)]
class OrderInvoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\Column(type: 'float')]
    private $total_paid_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_paid_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_discount_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_discount_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_products_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_products_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_tax_excl;

    #[ORM\Column(type: 'text')]
    private $invoice_address;

    #[ORM\Column(type: 'text')]
    private $delivery_address;

    #[ORM\Column(type: 'text', nullable: true)]
    private $note;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $delivery_at;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderInvoices')]
    private $ordered;

    #[ORM\OneToMany(mappedBy: 'orderInvoice', targetEntity: OrderInvoicePayment::class)]
    private $orderInvoicePayments;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'invoices')]
    private $customer;

    public function __construct()
    {
        $this->orderInvoicePayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTotalPaidTaxExcl(): ?float
    {
        return $this->total_paid_tax_excl;
    }

    public function setTotalPaidTaxExcl(float $total_paid_tax_excl): self
    {
        $this->total_paid_tax_excl = $total_paid_tax_excl;

        return $this;
    }

    public function getTotalPaidTaxIncl(): ?float
    {
        return $this->total_paid_tax_incl;
    }

    public function setTotalPaidTaxIncl(float $total_paid_tax_incl): self
    {
        $this->total_paid_tax_incl = $total_paid_tax_incl;

        return $this;
    }

    public function getTotalDiscountTaxExcl(): ?float
    {
        return $this->total_discount_tax_excl;
    }

    public function setTotalDiscountTaxExcl(float $total_discount_tax_excl): self
    {
        $this->total_discount_tax_excl = $total_discount_tax_excl;

        return $this;
    }

    public function getTotalDiscountTaxIncl(): ?float
    {
        return $this->total_discount_tax_incl;
    }

    public function setTotalDiscountTaxIncl(float $total_discount_tax_incl): self
    {
        $this->total_discount_tax_incl = $total_discount_tax_incl;

        return $this;
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

    public function getTotalShippingTaxIncl(): ?float
    {
        return $this->total_shipping_tax_incl;
    }

    public function setTotalShippingTaxIncl(float $total_shipping_tax_incl): self
    {
        $this->total_shipping_tax_incl = $total_shipping_tax_incl;

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

    public function getInvoiceAddress(): ?string
    {
        return $this->invoice_address;
    }

    public function setInvoiceAddress(string $invoice_address): self
    {
        $this->invoice_address = $invoice_address;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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

    public function getDeliveryAt(): ?\DateTimeInterface
    {
        return $this->delivery_at;
    }

    public function setDeliveryAt(\DateTimeInterface $delivery_at): self
    {
        $this->delivery_at = $delivery_at;

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
            $orderInvoicePayment->setOrderInvoice($this);
        }

        return $this;
    }

    public function removeOrderInvoicePayment(OrderInvoicePayment $orderInvoicePayment): self
    {
        if ($this->orderInvoicePayments->removeElement($orderInvoicePayment)) {
            // set the owning side to null (unless already changed)
            if ($orderInvoicePayment->getOrderInvoice() === $this) {
                $orderInvoicePayment->setOrderInvoice(null);
            }
        }

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
}
