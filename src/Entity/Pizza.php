<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PizzaRepository::class)
 */
class Pizza
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="pizza")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pizza;

    /**
     * @ORM\OneToMany(targetEntity=Size::class, mappedBy="Size")
     */
    private $size;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="pizza")
     */
    private $order_id;

    public function __construct()
    {
        $this->size = new ArrayCollection();
        $this->order_id = new ArrayCollection();
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

    public function getPizza(): ?Category
    {
        return $this->pizza;
    }

    public function setPizza(?Category $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    /**
     * @return Collection<int, Size>
     */
    public function getSize(): Collection
    {
        return $this->size;
    }

    public function addSize(Size $size): self
    {
        if (!$this->size->contains($size)) {
            $this->size[] = $size;
            $size->setSize($this);
        }

        return $this;
    }

    public function removeSize(Size $size): self
    {
        if ($this->size->removeElement($size)) {
            // set the owning side to null (unless already changed)
            if ($size->getSize() === $this) {
                $size->setSize(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderId(): Collection
    {
        return $this->order_id;
    }

    public function addOrderId(Order $orderId): self
    {
        if (!$this->order_id->contains($orderId)) {
            $this->order_id[] = $orderId;
            $orderId->setPizza($this);
        }

        return $this;
    }

    public function removeOrderId(Order $orderId): self
    {
        if ($this->order_id->removeElement($orderId)) {
            // set the owning side to null (unless already changed)
            if ($orderId->getPizza() === $this) {
                $orderId->setPizza(null);
            }
        }

        return $this;
    }
}
