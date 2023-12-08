<?php 

namespace Financas\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Financas\Enum\UserType;
use Financas\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'boolean', name: 'validate_email')]
    private bool $validateEmail;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'boolean', name: 'remember_password')]
    private bool $rememberPassword;

    #[ORM\Column(type: 'string', columnDefinition: 'ENUM("Admin", "Normal")')]
    private string $type = 'Normal';

    #[ORM\Column(type: 'datetime', name: 'created_at')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', name: 'last_login_at')]
    private \DateTimeInterface $lastLoginAt;

    #[ORM\Column(type: 'datetime', name: 'updated_at')]
    private \DateTimeInterface $updatedAt;

    #[ORM\OneToMany(targetEntity: Farmer::class, mappedBy: 'user')]
    private Collection $farmers;

    public function __construct()
    {
        $this->lastLoginAt      = new \DateTime();
        $this->createdAt        = new \DateTime();
        $this->updatedAt        = new \DateTime();
        $this->validateEmail    = false;
        $this->rememberPassword = false;
        $this->farmers          = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): self 
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email): self 
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setValidateEmail(bool $validateEmail): self 
    {
        $this->validateEmail = $validateEmail;

        return $this;
    }

    public function getValidateEmail(): bool
    {
        return $this->validateEmail;
    }

    public function setPassword(string $password): self 
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRememberPassword(bool $rememberPassword): self 
    {
        $this->rememberPassword = $rememberPassword;

        return $this;
    }

    public function getRememberPassword(): bool
    {
        return $this->rememberPassword;
    }

    public function setType(string $type): self 
    {
        if (!UserType::from($type)) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setLastLoginAt(\DateTimeInterface $lastLoginAt): self 
    {
        $this->lastLoginAt = $lastLoginAt;

        return $this;
    }

    public function getLastLoginAt(): \DateTimeInterface
    {
        return $this->lastLoginAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self 
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self 
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getFarmers(): Collection
    {
        return $this->farmers;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        }

        throw new \DomainException('Password do not match');
    }

    public function compare(string $password, string $confirmPassword): void
    {
        if ($password !== $confirmPassword) {
            throw new \DomainException('Passwords do not match');
        }
    }

    public function isAdmin(): bool
    {
        return UserType::ADMIN->value === $this->type;
    }
}