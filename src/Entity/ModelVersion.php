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

    #[ORM\Column(type: 'string', nullable: true)]
    private $begin_at;

    #[ORM\Column(type: 'string', nullable: true)]
    private $end_at;


    #[ORM\ManyToOne(targetEntity: VehicleModel::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private $model;

    #[ORM\Column(type: 'integer')]
    private $year;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $motorisation;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cv_f;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $frame;

    #[ORM\ManyToOne(targetEntity: VehicleMark::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle_mark;

    #[ORM\Column(type: 'string', length: 255)]
    private $mark_name;

    #[ORM\ManyToOne(targetEntity: VehicleRange::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: true)]
    private $vehicle_range;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $range_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $model_name;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'model_version')]
    private $products;

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

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->begin_at;
    }

    public function setBeginAt(\DateTimeInterface $begin_at): self
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->end_at;
    }

    public function setEndAt(\DateTimeInterface $end_at): self
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
        return $this->vehicle_mark;
    }

    public function setVehicleMark(?VehicleMark $vehicle_mark): self
    {
        $this->vehicle_mark = $vehicle_mark;

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

    public function setRangeName(string $range_name): self
    {
        $this->range_name = $range_name;

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

}
