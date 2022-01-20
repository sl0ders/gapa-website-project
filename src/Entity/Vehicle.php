<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $marque;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'string', length: 255)]
    private $version;

    #[ORM\Column(type: 'string', length: 255)]
    private $annees;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $moteur;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getAnnees(): ?string
    {
        return $this->annees;
    }

    public function setAnnees(string $annees): self
    {
        $this->annees = $annees;

        return $this;
    }

    public function getMoteur(): ?string
    {
        return $this->moteur;
    }

    public function setMoteur(string $moteur): self
    {
        $this->moteur = $moteur;

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
