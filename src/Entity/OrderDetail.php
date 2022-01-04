<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductName;

    #[ORM\Column(type: 'integer')]
    private $productQuantity;

    #[ORM\Column(type: 'float')]
    private $productPrice;

    #[ORM\Column(type: 'float')]
    private $unit_price_tax_incl;

    #[ORM\Column(type: 'float')]
    private $unit_price_tax_excl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_price_tax_incl;

    #[ORM\Column(type: 'float')]
    private $total_shipping_price_tax_excl;

    #[ORM\Column(type: 'float')]
    private $purchase_supplier_price;

    #[ORM\Column(type: 'float')]
    private $original_product_price;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'orderDetails')]
    private $product;

    #[ORM\OneToOne(inversedBy: 'orderDetail', targetEntity: Order::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $ordered;

    #[ORM\OneToMany(mappedBy: 'orderDetail', targetEntity: OrderReturnDetail::class)]
    private $orderReturnDetails;

    #[ORM\OneToMany(mappedBy: 'orderDetail', targetEntity: OrderSlipDetail::class)]
    private $orderSlipDetails;

    public function __construct()
    {
        $this->orderReturnDetails = new ArrayCollection();
        $this->orderSlipDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): self
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getUnitPriceTaxIncl(): ?float
    {
        return $this->unit_price_tax_incl;
    }

    public function setUnitPriceTaxIncl(float $unit_price_tax_incl): self
    {
        $this->unit_price_tax_incl = $unit_price_tax_incl;

        return $this;
    }

    public function getUnitPriceTaxExcl(): ?float
    {
        return $this->unit_price_tax_excl;
    }

    public function setUnitPriceTaxExcl(float $unit_price_tax_excl): self
    {
        $this->unit_price_tax_excl = $unit_price_tax_excl;

        return $this;
    }

    public function getTotalShippingPriceTaxIncl(): ?float
    {
        return $this->total_shipping_price_tax_incl;
    }

    public function setTotalShippingPriceTaxIncl(float $total_shipping_price_tax_incl): self
    {
        $this->total_shipping_price_tax_incl = $total_shipping_price_tax_incl;

        return $this;
    }

    public function getTotalShippingPriceTaxExcl(): ?float
    {
        return $this->total_shipping_price_tax_excl;
    }

    public function setTotalShippingPriceTaxExcl(float $total_shipping_price_tax_excl): self
    {
        $this->total_shipping_price_tax_excl = $total_shipping_price_tax_excl;

        return $this;
    }

    public function getPurchaseSupplierPrice(): ?float
    {
        return $this->purchase_supplier_price;
    }

    public function setPurchaseSupplierPrice(float $purchase_supplier_price): self
    {
        $this->purchase_supplier_price = $purchase_supplier_price;

        return $this;
    }

    public function getOriginalProductPrice(): ?float
    {
        return $this->original_product_price;
    }

    public function setOriginalProductPrice(float $original_product_price): self
    {
        $this->original_product_price = $original_product_price;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOrdered(): ?Order
    {
        return $this->ordered;
    }

    public function setOrdered(Order $ordered): self
    {
        $this->ordered = $ordered;

        return $this;
    }

    /**
     * @return Collection|OrderReturnDetail[]
     */
    public function getOrderReturnDetails(): Collection
    {
        return $this->orderReturnDetails;
    }

    public function addOrderReturnDetail(OrderReturnDetail $orderReturnDetail): self
    {
        if (!$this->orderReturnDetails->contains($orderReturnDetail)) {
            $this->orderReturnDetails[] = $orderReturnDetail;
            $orderReturnDetail->setOrderDetail($this);
        }

        return $this;
    }

    public function removeOrderReturnDetail(OrderReturnDetail $orderReturnDetail): self
    {
        if ($this->orderReturnDetails->removeElement($orderReturnDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderReturnDetail->getOrderDetail() === $this) {
                $orderReturnDetail->setOrderDetail(null);
            }
        }

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
            $orderSlipDetail->setOrderDetail($this);
        }

        return $this;
    }

    public function removeOrderSlipDetail(OrderSlipDetail $orderSlipDetail): self
    {
        if ($this->orderSlipDetails->removeElement($orderSlipDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderSlipDetail->getOrderDetail() === $this) {
                $orderSlipDetail->setOrderDetail(null);
            }
        }

        return $this;
    }
}
