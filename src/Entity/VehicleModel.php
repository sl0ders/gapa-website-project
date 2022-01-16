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

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: VehicleDeclination::class)]
    private $vehicleDeclinations;

    public function __construct()
    {
        $this->modelVersions = new ArrayCollection();
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
            $vehicleDeclination->setModel($this);
        }

        return $this;
    }

    public function removeVehicleDeclination(VehicleDeclination $vehicleDeclination): self
    {
        if ($this->vehicleDeclinations->removeElement($vehicleDeclination)) {
            // set the owning side to null (unless already changed)
            if ($vehicleDeclination->getModel() === $this) {
                $vehicleDeclination->setModel(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
