<?php

namespace App\Entity;

use App\Repository\VersionYearsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersionYearsRepository::class)]
class VersionYears
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'versionYears', targetEntity: ModelVersion::class)]
    private $version;

    public function __construct()
    {
        $this->version = new ArrayCollection();
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
    public function getVersion(): Collection
    {
        return $this->version;
    }

    public function addVersion(ModelVersion $version): self
    {
        if (!$this->version->contains($version)) {
            $this->version[] = $version;
            $version->setVersionYears($this);
        }

        return $this;
    }

    public function removeVersion(ModelVersion $version): self
    {
        if ($this->version->removeElement($version)) {
            // set the owning side to null (unless already changed)
            if ($version->getVersionYears() === $this) {
                $version->setVersionYears(null);
            }
        }

        return $this;
    }
}
