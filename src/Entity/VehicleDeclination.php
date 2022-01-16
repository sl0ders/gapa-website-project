<?php

namespace App\Entity;

use App\Repository\VehicleDeclinationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleDeclinationRepository::class)]
class VehicleDeclination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: VehicleMark::class, inversedBy: 'vehicleDeclinations')]
    #[ORM\JoinColumn(nullable: false)]
    private $mark;

    #[ORM\ManyToOne(targetEntity: VehicleModel::class, inversedBy: 'vehicleDeclinations')]
    #[ORM\JoinColumn(nullable: false)]
    private $model;

    #[ORM\ManyToOne(targetEntity: ModelVersion::class, inversedBy: 'vehicleDeclinations')]
    #[ORM\JoinColumn(nullable: false)]
    private $modelVersion;

    #[ORM\ManyToOne(targetEntity: VersionFrame::class, inversedBy: 'vehicleDeclinations')]
    private $frame;

    #[ORM\ManyToOne(targetEntity: VersionMotorisation::class, inversedBy: 'vehicleDeclinations')]
    private $motorisation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?VehicleMark
    {
        return $this->mark;
    }

    public function setMark(?VehicleMark $mark): self
    {
        $this->mark = $mark;

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

    public function getFrame(): ?VersionFrame
    {
        return $this->frame;
    }

    public function setFrame(?VersionFrame $frame): self
    {
        $this->frame = $frame;

        return $this;
    }

    public function getModelVersion(): ?ModelVersion
    {
        return $this->modelVersion;
    }

    public function setModelVersion(?ModelVersion $modelVersion): self
    {
        $this->modelVersion = $modelVersion;

        return $this;
    }

    public function getMotorisation(): ?VersionMotorisation
    {
        return $this->motorisation;
    }

    public function setMotorisation(?VersionMotorisation $motorisation): self
    {
        $this->motorisation = $motorisation;

        return $this;
    }

    public function __toString(): string
    {
      return $this->mark . " " . $this->model ." ". $this->modelVersion . " ". $this->frame ." " . $this->motorisation;
    }
}
