<?php

namespace App\Entity;

use App\Repository\ModelVersionRepository;
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

    #[ORM\Column(type: 'datetime')]
    private $begin_at;

    #[ORM\Column(type: 'datetime')]
    private $end_at;

    #[ORM\OneToOne(mappedBy: 'modelVersion', targetEntity: VersionMotorisation::class, cascade: ['persist', 'remove'])]
    private $versionMotorisation;

    #[ORM\OneToOne(mappedBy: 'modelVersion', targetEntity: VersionFrame::class, cascade: ['persist', 'remove'])]
    private $versionFrame;

    #[ORM\ManyToOne(targetEntity: VehicleModel::class, inversedBy: 'modelVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private $model;

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

    public function getVersionMotorisation(): ?VersionMotorisation
    {
        return $this->versionMotorisation;
    }

    public function setVersionMotorisation(?VersionMotorisation $versionMotorisation): self
    {
        // unset the owning side of the relation if necessary
        if ($versionMotorisation === null && $this->versionMotorisation !== null) {
            $this->versionMotorisation->setModelVersion(null);
        }

        // set the owning side of the relation if necessary
        if ($versionMotorisation !== null && $versionMotorisation->getModelVersion() !== $this) {
            $versionMotorisation->setModelVersion($this);
        }

        $this->versionMotorisation = $versionMotorisation;

        return $this;
    }

    public function getVersionFrame(): ?VersionFrame
    {
        return $this->versionFrame;
    }

    public function setVersionFrame(VersionFrame $versionFrame): self
    {
        // set the owning side of the relation if necessary
        if ($versionFrame->getModelVersion() !== $this) {
            $versionFrame->setModelVersion($this);
        }

        $this->versionFrame = $versionFrame;

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
}
