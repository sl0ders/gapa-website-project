<?php

namespace App\Entity;

use App\Repository\VersionMotorisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersionMotorisationRepository::class)]
class VersionMotorisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(inversedBy: 'versionMotorisation', targetEntity: ModelVersion::class, cascade: ['persist', 'remove'])]
    private $modelVersion;

    #[ORM\OneToMany(mappedBy: 'versionMotorisation', targetEntity: Product::class)]
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

    public function getModelVersion(): ?ModelVersion
    {
        return $this->modelVersion;
    }

    public function setModelVersion(?ModelVersion $modelVersion): self
    {
        $this->modelVersion = $modelVersion;

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
            $product->setVersionMotorisation($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVersionMotorisation() === $this) {
                $product->setVersionMotorisation(null);
            }
        }

        return $this;
    }
}
