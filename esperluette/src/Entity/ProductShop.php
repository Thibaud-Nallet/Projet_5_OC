<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductShopRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"title"},
 *  message="Une autre annonce possède déjà ce titre"
 * )
 */
class ProductShop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=1, max=255, minMessage="Le titre est trop petit")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min=1, max=255, minMessage="L'introduction est trop petit")
     */
    private $introduction;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min=1, minMessage="Au moins 100 caractères")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverImage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageShop", mappedBy="id_product", orphanRemoval=true)
     * @Assert\Valid()
     */
    private $imagesShop;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    public function __construct()
    {
        $this->imagesShop = new ArrayCollection();
    }

    /**
     * Permet d'initialiser le slug
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initSlug()
    {
        if(empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(?string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return Collection|ImageShop[]
     */
    public function getImagesShop(): Collection
    {
        return $this->imagesShop;
    }

    public function addImagesShop(ImageShop $imagesShop): self
    {
        if (!$this->imagesShop->contains($imagesShop)) {
            $this->imagesShop[] = $imagesShop;
            $imagesShop->setIdProduct($this);
        }

        return $this;
    }

    public function removeImagesShop(ImageShop $imagesShop): self
    {
        if ($this->imagesShop->contains($imagesShop)) {
            $this->imagesShop->removeElement($imagesShop);
            // set the owning side to null (unless already changed)
            if ($imagesShop->getIdProduct() === $this) {
                $imagesShop->setIdProduct(null);
            }
        }

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }
}
