<?php

namespace App\Entity;

use App\Repository\ModelVersionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelVersionRepository::class)]
class ModelVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: VehicleModel::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private $model;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $motorisation;

    #[ORM\ManyToOne(targetEntity: VehicleMark::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicleMark;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'modelVersion')]
    private $products;

    #[ORM\ManyToOne(targetEntity: VersionYears::class, inversedBy: 'version')]
    #[ORM\JoinColumn(nullable: false)]
    private $versionYears;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    public function __construct()
    {
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

    public function getBeginAt(): ?string
    {
        return $this->begin_at;
    }

    public function setBeginAt(string $begin_at): self
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    public function getEndAt(): ?string
    {
        return $this->end_at;
    }

    public function setEndAt(string $end_at): self
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getModel(): ?VehicleModel
    {
        return $this->model;
    }

    public function setModel(?VehicleModel $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMotorisation(): ?string
    {
        return $this->motorisation;
    }

    public function setMotorisation(string $motorisation): self
    {
        $this->motorisation = $motorisation;

        return $this;
    }

    public function getCvF(): ?int
    {
        return $this->cv_f;
    }

    public function setCvF(int $cv_f): self
    {
        $this->cv_f = $cv_f;

        return $this;
    }

    public function getFrame(): ?string
    {
        return $this->frame;
    }

    public function setFrame(string $frame): self
    {
        $this->frame = $frame;

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

    public function getMarkName(): ?string
    {
        return $this->mark_name;
    }

    public function setMarkName(string $mark_name): self
    {
        $this->mark_name = $mark_name;

        return $this;
    }



    public function getModelName(): ?string
    {
        return $this->model_name;
    }

    public function setModelName(string $model_name): self
    {
        $this->model_name = $model_name;

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
            $product->addModelVersion($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeModelVersion($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getVersionYears(): ?VersionYears
    {
        return $this->versionYears;
    }

    public function setVersionYears(?VersionYears $versionYears): self
    {
        $this->versionYears = $versionYears;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

}
