<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
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

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: File::class)]
    private $files;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Picture::class, orphanRemoval: true)]
    private $pictures;

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

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
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

    /**
     * @return Collection|File[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setProduct($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getProduct() === $this) {
                $file->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

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
}
