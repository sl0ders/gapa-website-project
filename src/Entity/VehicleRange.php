<?php

namespace App\Entity;

use App\Repository\VehicleRangeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRangeRepository::class)]
class VehicleRange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $mark_name;

    #[ORM\ManyToOne(targetEntity: VehicleMark::class, inversedBy: 'vehicleRanges')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle_mark;

    #[ORM\OneToMany(mappedBy: 'vehicle_range', targetEntity: VehicleModel::class)]
    private $vehicleModels;

    #[ORM\OneToMany(mappedBy: 'vehicle_range', targetEntity: ModelVersion::class, orphanRemoval: true)]
    private $modelVersions;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'vehicleRange')]
    private $products;

    public function __construct()
    {
        $this->vehicle_mark = new ArrayCollection();
        $this->vehicleModels = new ArrayCollection();
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

    public function getMarkName(): ?string
    {
        return $this->mark_name;
    }

    public function setMarkName(string $mark_name): self
    {
        $this->mark_name = $mark_name;

        return $this;
    }

    public function getVehicleMark(): ?VehicleMark
    {
        return $this->vehicle_mark;
    }

    public function setVehicleMark(?VehicleMark $vehicle_mark): self
    {
        $this->vehicle_mark = $vehicle_mark;

        return $this;
    }

    /**
     * @return Collection|VehicleModel[]
     */
    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }

    public function addVehicleModel(VehicleModel $vehicleModel): self
    {
        if (!$this->vehicleModels->contains($vehicleModel)) {
            $this->vehicleModels[] = $vehicleModel;
            $vehicleModel->setVehicleRange($this);
        }

        return $this;
    }

    public function removeVehicleModel(VehicleModel $vehicleModel): self
    {
        if ($this->vehicleModels->removeElement($vehicleModel)) {
            // set the owning side to null (unless already changed)
            if ($vehicleModel->getVehicleRange() === $this) {
                $vehicleModel->setVehicleRange(null);
            }
        }

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
            $modelVersion->setVehicleRange($this);
        }

        return $this;
    }

    public function removeModelVersion(ModelVersion $modelVersion): self
    {
        if ($this->modelVersions->removeElement($modelVersion)) {
            // set the owning side to null (unless already changed)
            if ($modelVersion->getVehicleRange() === $this) {
                $modelVersion->setVehicleRange(null);
            }
        }

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
            $product->addVehicleRange($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeVehicleRange($this);
        }

        return $this;
    }
}
