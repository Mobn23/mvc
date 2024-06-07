<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    /**
     * @var int|null The ID of the product.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null The name of the product.
     *
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var int|null The value of the product.
     *
     * @ORM\Column(type="integer")
     */
    #[ORM\Column]
    private ?int $value = null;

    /**
     * Get the ID of the product.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the name of the product.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the product.
     *
     * @param string $name
     * @return static
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of the product.
     *
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * Set the value of the product.
     *
     * @param int $value
     * @return static
     */
    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }
}
