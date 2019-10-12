<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryShopRepository")
 */
class CategoryShop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductShop", mappedBy="categoryShop")
     */
    private $idProduct;

    public function __construct()
    {
        $this->idProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|ProductShop[]
     */
    public function getIdProduct(): Collection
    {
        return $this->idProduct;
    }

    public function addIdProduct(ProductShop $idProduct): self
    {
        if (!$this->idProduct->contains($idProduct)) {
            $this->idProduct[] = $idProduct;
            $idProduct->setCategoryShop($this);
        }

        return $this;
    }

    public function removeIdProduct(ProductShop $idProduct): self
    {
        if ($this->idProduct->contains($idProduct)) {
            $this->idProduct->removeElement($idProduct);
            // set the owning side to null (unless already changed)
            if ($idProduct->getCategoryShop() === $this) {
                $idProduct->setCategoryShop(null);
            }
        }

        return $this;
    }
}
