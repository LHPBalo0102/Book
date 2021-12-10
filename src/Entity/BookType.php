<?php

namespace App\Entity;

use App\Repository\BookTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=BookTypeRepository::class)
 * @ORM\Table(name="book_type")
 * @UniqueEntity("type")
 * @UniqueEntity("code")
 */
class BookType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="type", orphanRemoval=true)
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBooks(Book $books): self
    {
        if (!$this->books->contains($books)) {
            $this->books[] = $books;
            $books->setType($this);
        }

        return $this;
    }

    public function removeBooks(Book $books): self
    {
        if ($this->books->removeElement($books)) {
            // set the owning side to null (unless already changed)
            if ($books->getType() === $this) {
                $books->setType(null);
            }
        }

        return $this;
    }
}
