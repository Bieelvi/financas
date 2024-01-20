<?php 

namespace Financas\Entity;

use Doctrine\ORM\Mapping as ORM;
use Financas\Enum\Language;
use Financas\Enum\Theme;
use Financas\Repository\UserConfigRepository;

#[ORM\Entity(repositoryClass: UserConfigRepository::class)]
#[ORM\Table(name: 'user_configurations')]
class UserConfig
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'configs')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user;

    #[ORM\Column(type: 'string', columnDefinition: 'ENUM("pt_br", "en")')]
    private string $language;

    #[ORM\Column(type: 'string')]
    private string $timezone;

    #[ORM\Column(type: 'string', columnDefinition: 'ENUM("dark", "light")')]
    private string $theme;

    #[ORM\Column(type: 'datetime', name: 'created_at')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', name: 'updated_at')]
    private \DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUser(User $user): self 
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setLanguage(string $language): self 
    {
        if (!Language::from($language)) {
            throw new \InvalidArgumentException(translate("Invalid language"));
        }

        $this->language = $language;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setTimezone(string $timezone): self 
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTheme(string $theme): self 
    {
        if (!Theme::from($theme)) {
            throw new \InvalidArgumentException(translate("Invalid theme"));
        }

        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): string
    {
        return $this->theme;
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
}