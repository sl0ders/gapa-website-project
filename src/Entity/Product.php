<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[UniqueEntity("reference")]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $OriginalReference;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'float', nullable: true)]
    private $lenght;

    #[ORM\Column(type: 'float', nullable: true)]
    private $width;

    #[ORM\Column(type: 'float', nullable: true)]
    private $height;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'float')]
    private $price_ttc;

    #[ORM\Column(type: 'text', nullable: true)]
    private $specificity;

    #[ORM\Column(type: 'text', nullable: true)]
    private $meta_description;

    #[ORM\Column(type: 'text', nullable: true)]
    private $meta_title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $meta_keyword;

    #[ORM\Column(type: 'integer')]
    private $position;

    #[ORM\Column(type: 'boolean')]
    private $is_enabled;

    #[ORM\Column(type: 'datetime')]
    private $add_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: ProductType::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    #[ORM\ManyToOne(targetEntity: Provider::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $provider;

    #[ORM\ManyToOne(targetEntity: VersionMotorisation::class, inversedBy: 'products')]
    private $versionMotorisation;

    #[ORM\ManyToOne(targetEntity: VersionFrame::class, inversedBy: 'products')]
    private $versionFrame;

    #[ORM\ManyToMany(targetEntity: Order::class, mappedBy: 'products')]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetail::class)]
    private $orderDetails;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: CartProduct::class)]
    private $cartProducts;

    #[ORM\Column(type: 'float', nullable: true)]
    private $depth;

    #[ORM\Column(type: 'float', nullable: true)]
    private $depth_in;

    #[ORM\Column(type: 'float', nullable: true)]
    private $weight;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private $upc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $countryOfOrigin;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private $currency;

    #[ORM\Column(type: 'float', nullable: true)]
    private $retail_price;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tariffcode;

    #[ORM\ManyToMany(targetEntity: Picture::class, cascade: ["persist"])]
    private $pictures;

    #[ORM\ManyToMany(targetEntity: Attachment::class, cascade: ["persist"])]
    private $attachment;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $is_in_stock;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'products', cascade: ["persist"])]
    private $categories;

    #[ORM\Column(type: 'boolean')]
    private $is_on_sale;

    #[Pure] public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
        $this->cartProducts = new ArrayCollection();
        $this->attachment = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalReference(): ?string
    {
        return $this->OriginalReference;
    }

    public function setOriginalReference(?string $OriginalReference): self
    {
        $this->OriginalReference = $OriginalReference;

        return $this;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLenght(): ?float
    {
        return $this->lenght;
    }

    public function setLenght(?float $lenght): self
    {
        $this->lenght = $lenght;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
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

    public function getPriceTtc(): ?float
    {
        return $this->price_ttc;
    }

    public function setPriceTtc(float $price_ttc): self
    {
        $this->price_ttc = $price_ttc;

        return $this;
    }

    public function getSpecificity(): ?string
    {
        return $this->specificity;
    }

    public function setSpecificity(?string $specificity): self
    {
        $this->specificity = $specificity;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(?string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;
    }

    public function setMetaTitle(?string $meta_title): self
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaKeyword(): ?string
    {
        return $this->meta_keyword;
    }

    public function setMetaKeyword(?string $meta_keyword): self
    {
        $this->meta_keyword = $meta_keyword;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->is_enabled;
    }

    public function setIsEnabled(bool $is_enabled): self
    {
        $this->is_enabled = $is_enabled;

        return $this;
    }

    public function getAddAt(): ?\DateTimeInterface
    {
        return $this->add_at;
    }

    public function setAddAt(\DateTimeInterface $add_at): self
    {
        $this->add_at = $add_at;

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

    public function getType(): ?ProductType
    {
        return $this->type;
    }

    public function setType(?ProductType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getVersionMotorisation(): ?VersionMotorisation
    {
        return $this->versionMotorisation;
    }

    public function setVersionMotorisation(?VersionMotorisation $versionMotorisation): self
    {
        $this->versionMotorisation = $versionMotorisation;

        return $this;
    }

    public function getVersionFrame(): ?VersionFrame
    {
        return $this->versionFrame;
    }

    public function setVersionFrame(?VersionFrame $versionFrame): self
    {
        $this->versionFrame = $versionFrame;

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
            $order->addProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
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
            $cartProduct->setProduct($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProducts->removeElement($cartProduct)) {
            // set the owning side to null (unless already changed)
            if ($cartProduct->getProduct() === $this) {
                $cartProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getDepth(): ?float
    {
        return $this->depth;
    }

    public function setDepth(?float $depth): self
    {
        $this->depth = $depth;

        return $this;
    }

    public function getDepthIn(): ?float
    {
        return $this->depth_in;
    }

    public function setDepthIn(?float $depth_in): self
    {
        $this->depth_in = $depth_in;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getUpc(): ?string
    {
        return $this->upc;
    }

    public function setUpc(?string $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    public function getCountryOfOrigin(): ?string
    {
        return $this->countryOfOrigin;
    }

    public function setCountryOfOrigin(?string $countryOfOrigin): self
    {
        $this->countryOfOrigin = $countryOfOrigin;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getRetailPrice(): ?float
    {
        return $this->retail_price;
    }

    public function setRetailPrice(?float $retail_price): self
    {
        $this->retail_price = $retail_price;

        return $this;
    }

    public function getTariffcode(): ?string
    {
        return $this->tariffcode;
    }

    public function setTariffcode(?string $tariffcode): self
    {
        $this->tariffcode = $tariffcode;

        return $this;
    }


    public function getPictures()
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        $this->pictures->removeElement($picture);

        return $this;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

    public function addAttachment(?Attachment $attachment): self
    {
        if (!$this->attachment->contains($attachment)) {
            $this->attachment[] = $attachment;
        }

        return $this;
    }

    public function removeAttachment(?Attachment $attachment): self
    {
        $this->attachment->removeElement($attachment);
        return $this;
    }

    public function getIsInStock(): ?int
    {
        return $this->is_in_stock;
    }

    public function setIsInStock(?int $is_in_stock): self
    {
        $this->is_in_stock = $is_in_stock;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getIsOnSale(): ?bool
    {
        return $this->is_on_sale;
    }

    public function setIsOnSale(bool $is_on_sale): self
    {
        $this->is_on_sale = $is_on_sale;

        return $this;
    }
}
