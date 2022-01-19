<?php

namespace App\Entity;

use App\Repository\VehicleMarkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleMarkRepository::class)]
class VehicleMark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'vehicleMark', targetEntity: VehicleModel::class, orphanRemoval: true)]
    private $vehicleModels;

    #[ORM\OneToOne(targetEntity: Picture::class, cascade: ['persist', 'remove'])]
    private $picture;

    #[ORM\ManyToMany(targetEntity: Provider::class, inversedBy: 'vehicleMarks')]
    private $provider;


    #[ORM\Column(type: 'boolean', options: ["default" => 1])]
    private $enabled = 1;

    #[ORM\OneToMany(mappedBy: 'vehicleMark', targetEntity: VehicleRange::class, orphanRemoval: true)]
    private $vehicleRanges;

    #[ORM\OneToMany(mappedBy: 'vehicleMark', targetEntity: ModelVersion::class)]
    private $modelVersions;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'mark')]
    private $products;


    public function __construct()
    {
        $this->vehicleModels = new ArrayCollection();
        $this->provider = new ArrayCollection();
        $this->vehicleRanges = new ArrayCollection();
        $this->modelVersions = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
            $vehicleModel->setVehicleMark($this);
        }

        return $this;
    }

    public function removeVehicleModel(VehicleModel $vehicleModel): self
    {
        if ($this->vehicleModels->removeElement($vehicleModel)) {
            // set the owning side to null (unless already changed)
            if ($vehicleModel->getVehicleMark() === $this) {
                $vehicleModel->setVehicleMark(null);
            }
        }

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
     * @return Collection|Provider[]
     */
    public function getProvider(): Collection
    {
        return $this->provider;
    }

    public function addProvider(Provider $provider): self
    {
        if (!$this->provider->contains($provider)) {
            $this->provider[] = $provider;
        }

        return $this;
    }

    public function removeProvider(Provider $provider): self
    {
        $this->provider->removeElement($provider);

        return $this;
    }

    public function __toString(): string
    {
      return $this->name;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return Collection|VehicleRange[]
     */
    public function getVehicleRanges(): Collection
    {
        return $this->vehicleRanges;
    }

    public function addVehicleRange(VehicleRange $vehicleRange): self
    {
        if (!$this->vehicleRanges->contains($vehicleRange)) {
            $this->vehicleRanges[] = $vehicleRange;
            $vehicleRange->setVehicleMark($this);
        }

        return $this;
    }

    public function removeVehicleRange(VehicleRange $vehicleRange): self
    {
        if ($this->vehicleRanges->removeElement($vehicleRange)) {
            // set the owning side to null (unless already changed)
            if ($vehicleRange->getVehicleMark() === $this) {
                $vehicleRange->setVehicleMark(null);
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
            $modelVersion->setVehicleMark($this);
        }

        return $this;
    }

    public function removeModelVersion(ModelVersion $modelVersion): self
    {
        if ($this->modelVersions->removeElement($modelVersion)) {
            // set the owning side to null (unless already changed)
            if ($modelVersion->getVehicleMark() === $this) {
                $modelVersion->setVehicleMark(null);
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
            $product->addMark($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeMark($this);
        }

        return $this;
    }
}
