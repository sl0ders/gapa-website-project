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

    #[ORM\OneToMany(mappedBy: 'mark', targetEntity: VehicleDeclination::class)]
    private $vehicleDeclinations;

    public function __construct()
    {
        $this->vehicleModels = new ArrayCollection();
        $this->provider = new ArrayCollection();
        $this->vehicleDeclinations = new ArrayCollection();
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

    /**
     * @return Collection|VehicleDeclination[]
     */
    public function getVehicleDeclinations(): Collection
    {
        return $this->vehicleDeclinations;
    }

    public function addVehicleDeclination(VehicleDeclination $vehicleDeclination): self
    {
        if (!$this->vehicleDeclinations->contains($vehicleDeclination)) {
            $this->vehicleDeclinations[] = $vehicleDeclination;
            $vehicleDeclination->setMark($this);
        }

        return $this;
    }

    public function removeVehicleDeclination(VehicleDeclination $vehicleDeclination): self
    {
        if ($this->vehicleDeclinations->removeElement($vehicleDeclination)) {
            // set the owning side to null (unless already changed)
            if ($vehicleDeclination->getMark() === $this) {
                $vehicleDeclination->setMark(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
      return $this->name;
    }
}
