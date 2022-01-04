<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $path;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $id_path;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $read_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getIdPath(): ?int
    {
        return $this->id_path;
    }

    public function setIdPath(?int $id_path): self
    {
        $this->id_path = $id_path;

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

    public function getReadAt(): ?\DateTimeInterface
    {
        return $this->read_at;
    }

    public function setReadAt(?\DateTimeInterface $read_at): self
    {
        $this->read_at = $read_at;

        return $this;
    }
}
