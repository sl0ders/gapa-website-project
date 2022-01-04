<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 13)]
    private $phone;

    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $address;

    #[ORM\OneToOne(targetEntity: Picture::class, cascade: ['persist', 'remove'])]
    private $picture;

    #[ORM\OneToMany(mappedBy: 'provider', targetEntity: Product::class)]
    private $products;

    #[ORM\ManyToMany(targetEntity: VehicleMark::class, mappedBy: 'provider')]
    private $vehicleMarks;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->vehicleMarks = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

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
            $product->setProvider($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProvider() === $this) {
                $product->setProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VehicleMark[]
     */
    public function getVehicleMarks(): Collection
    {
        return $this->vehicleMarks;
    }

    public function addVehicleMark(VehicleMark $vehicleMark): self
    {
        if (!$this->vehicleMarks->contains($vehicleMark)) {
            $this->vehicleMarks[] = $vehicleMark;
            $vehicleMark->addProvider($this);
        }

        return $this;
    }

    public function removeVehicleMark(VehicleMark $vehicleMark): self
    {
        if ($this->vehicleMarks->removeElement($vehicleMark)) {
            $vehicleMark->removeProvider($this);
        }

        return $this;
    }
}
