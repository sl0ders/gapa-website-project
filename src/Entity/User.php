<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
#[UniqueEntity("email" , message: "Cet adresse email existe deja. Veuillez en choisir une autre")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\NotBlank(message: "Champ non remplie")]
    #[Assert\Email(message: "Addresse email non conforme")]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[Assert\NotBlank(message: "Champ de mot de passe obligatoire")]
    #[Assert\Length(min: "5", minMessage: "Mot de passe trop court")]
    #[ORM\Column(type: 'string')]
    private $password;

    #[Assert\NotBlank(message: "Champ de confirmation de mot de passe obligatoire")]
    #[Assert\EqualTo(propertyPath: "password", message: "Les mots de passe ne correspondent pas")]
    private $confirmPassword;

    #[ORM\Column(type: 'string', length: 3)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Prenom obligatoire")]
    #[Assert\Length(min: "2", minMessage: "Prenom trop court")]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "Nom de famille obligatoire")]
    #[Assert\Length(min: "2", minMessage: "Nom de famille trop court")]
    private $lastname;

    #[ORM\Column(type: 'datetime')]
    private $created_at;


    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\OneToOne(targetEntity: Address::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $address;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
