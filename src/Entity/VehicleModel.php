<?php

namespace App\Entity;

use App\Repository\VehicleModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleModelRepository::class)]
class VehicleModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: ModelVersion::class, orphanRemoval: true)]
    private $modelVersions;

    #[ORM\ManyToOne(targetEntity: VehicleMark::class, inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicleMark;

    #[ORM\ManyToOne(targetEntity: VehicleRange::class, inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(nullable: true)]
    private $vehicle_range;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[ORM\JoinColumn(nullable: true)]
    private $range_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $mark_name;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'vehicleModel')]
    private $products;

    public function __construct()
    {
        $this->modelVersions = new ArrayCollection();
        $this->products = new ArrayCollection();
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

    /**
     * @return Collection|ModelVersion[]
     */
    public function getModelVersions(): Collection
    {
        return $this->modelVersions;
    }

    public function addModelVersion(ModelVersion $modelVersion): self
    {
        if (!$this->modelVersions->contains($modelVersion)) {
            $this->modelVersions[] = $modelVersion;
            $modelVersion->setModel($this);
        }

        return $this;
    }

    public function removeModelVersion(ModelVersion $modelVersion): self
    {
        if ($this->modelVersions->removeElement($modelVersion)) {
            // set the owning side to null (unless already changed)
            if ($modelVersion->getModel() === $this) {
                $modelVersion->setModel(null);
            }
        }

        return $this;
    }

    public function getVehicleMark(): ?VehicleMark
    {
        return $this->vehicleMark;
    }

    public function setVehicleMark(?VehicleMark $vehicleMark): self
    {
        $this->vehicleMark = $vehicleMark;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getVehicleRange(): ?VehicleRange
    {
        return $this->vehicle_range;
    }

    public function setVehicleRange(?VehicleRange $vehicle_range): self
    {
        $this->vehicle_range = $vehicle_range;

        return $this;
    }

    public function getRangeName(): ?string
    {
        return $this->range_name;
    }

    public function setRangeName(?string $range_name): self
    {
        $this->range_name = $range_name;

        return $this;
    }

    public function getMarkName(): ?string
    {
        return $this->mark_name;
    }

    public function setMarkName(string $mark_name): self
    {
        $this->mark_name = $mark_name;

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
            $product->addVehicleModel($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeVehicleModel($this);
        }

        return $this;
    }
}
