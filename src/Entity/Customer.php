<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $is_add_newsletter;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $newsletter_sub_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $last_visit;

    #[ORM\Column(type: 'text', nullable: true)]
    private $note;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $birthday;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'customers')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: OrderInvoice::class)]
    private $invoices;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Order::class)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Cart::class)]
    private $carts;

    public function __construct()
    {
        $this->invoices = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsAddNewsletter(): ?bool
    {
        return $this->is_add_newsletter;
    }

    public function setIsAddNewsletter(bool $is_add_newsletter): self
    {
        $this->is_add_newsletter = $is_add_newsletter;

        return $this;
    }

    public function getNewsletterSubAt(): ?\DateTimeInterface
    {
        return $this->newsletter_sub_at;
    }

    public function setNewsletterSubAt(?\DateTimeInterface $newsletter_sub_at): self
    {
        $this->newsletter_sub_at = $newsletter_sub_at;

        return $this;
    }

    public function getLastVisit(): ?\DateTimeInterface
    {
        return $this->last_visit;
    }

    public function setLastVisit(?\DateTimeInterface $last_visit): self
    {
        $this->last_visit = $last_visit;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|OrderInvoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(OrderInvoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setCustomer($this);
        }

        return $this;
    }

    public function removeInvoice(OrderInvoice $invoice): self
    {
        if ($this->invoices->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getCustomer() === $this) {
                $invoice->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setCustomer($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getCustomer() === $this) {
                $cart->setCustomer(null);
            }
        }

        return $this;
    }
}