<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarousselRepository")
 */
class Caroussel
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
    private $src_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alt_image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSrcImage(): ?string
    {
        return $this->src_image;
    }

    public function setSrcImage(string $src_image): self
    {
        $this->src_image = $src_image;

        return $this;
    }

    public function getAltImage(): ?string
    {
        return $this->alt_image;
    }

    public function setAltImage(string $alt_image): self
    {
        $this->alt_image = $alt_image;

        return $this;
    }
}
