<?php

namespace App\Entity;

use App\Repository\OrderReturnRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderReturnRepository::class)]
class OrderReturn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $state;

    #[ORM\Column(type: 'text', nullable: true)]
    private $question;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderReturns')]
    private $ordered;

    #[ORM\OneToMany(mappedBy: 'orderReturn', targetEntity: OrderReturnDetail::class)]
    private $orderReturnDetails;

    public function __construct()
    {
        $this->orderReturnDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getOrdered(): ?Order
    {
        return $this->ordered;
    }

    public function setOrdered(?Order $ordered): self
    {
        $this->ordered = $ordered;

        return $this;
    }

    /**
     * @return Collection|OrderReturnDetail[]
     */
    public function getOrderReturnDetails(): Collection
    {
        return $this->orderReturnDetails;
    }

    public function addOrderReturnDetail(OrderReturnDetail $orderReturnDetail): self
    {
        if (!$this->orderReturnDetails->contains($orderReturnDetail)) {
            $this->orderReturnDetails[] = $orderReturnDetail;
            $orderReturnDetail->setOrderReturn($this);
        }

        return $this;
    }

    public function removeOrderReturnDetail(OrderReturnDetail $orderReturnDetail): self
    {
        if ($this->orderReturnDetails->removeElement($orderReturnDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderReturnDetail->getOrderReturn() === $this) {
                $orderReturnDetail->setOrderReturn(null);
            }
        }

        return $this;
    }
}
