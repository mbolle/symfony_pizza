<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Pizza::class, mappedBy="pizza")
     */
    private $pizza;

    public function __construct()
    {
        $this->pizza = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizza->contains($pizza)) {
            $this->pizza[] = $pizza;
            $pizza->setPizza($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizza->removeElement($pizza)) {
            // set the owning side to null (unless already changed)
            if ($pizza->getPizza() === $this) {
                $pizza->setPizza(null);
            }
        }

        return $this;
    }
}

