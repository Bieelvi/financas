<?php 

namespace Financas\Entity;

use Doctrine\ORM\Mapping as ORM;
use Financas\Enum\ProductType;
use Financas\Repository\FarmerRepository;

#[ORM\Entity(repositoryClass: FarmerRepository::class)]
#[ORM\Table(name: 'farmer')]
class Farmer
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'farmers')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User|null $user = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'farmers')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product|null $product = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'string', columnDefinition: 'ENUM("Gain", "Spent")')]
    private string $type;

    #[ORM\Column(type: 'float')]
    private float $value;

    #[ORM\Column(type: 'text', nullable: true)]
    private string|null $observation = null;

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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setProduct(Product $product): self 
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setDate(\DateTimeInterface $date): self 
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setType(string $type): self 
    {
        if (!ProductType::from($type)) {
            throw new \InvalidArgumentException(translate("Invalid type"));
        }

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setValue(float $value): self 
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(bool $formatted = false): float|string
    {
        if ($formatted) {
            return "R$ " . number_format($this->value, 2, ',', '.');
        }

        return $this->value;
    }

    public function setObservation(?string $observation): self 
    {
        $this->observation = $observation;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
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