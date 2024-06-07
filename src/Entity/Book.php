<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * Class Book
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    /**
     * @var int|null The ID of the book.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    // #[ORM\GeneratedValue] //This Auto increment
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null The name of the book.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    /**
     * @var string|null The author of the book.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    /**
     * @var string|null The image URL or path of the book.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * Get the ID of the book.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the ID of the book.
     *
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the name of the book.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the name of the book.
     *
     * @param string|null $name
     * @return static
     */
    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the author of the book.
     *
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Set the author of the book.
     *
     * @param string|null $author
     * @return static
     */
    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the image URL or path of the book.
     *
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the image URL or path of the book.
     *
     * @param string|null $image
     * @return static
     */
    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
