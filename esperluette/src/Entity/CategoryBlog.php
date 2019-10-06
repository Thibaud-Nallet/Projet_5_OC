<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryBlogRepository")
 */
class CategoryBlog
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticlesBlog", mappedBy="categoryBlog")
     */
    private $id_articles;

    public function __construct()
    {
        $this->id_articles = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ArticlesBlog[]
     */
    public function getIdArticles(): Collection
    {
        return $this->id_articles;
    }

    public function addIdArticle(ArticlesBlog $idArticle): self
    {
        if (!$this->id_articles->contains($idArticle)) {
            $this->id_articles[] = $idArticle;
            $idArticle->setCategoryBlog($this);
        }

        return $this;
    }

    public function removeIdArticle(ArticlesBlog $idArticle): self
    {
        if ($this->id_articles->contains($idArticle)) {
            $this->id_articles->removeElement($idArticle);
            // set the owning side to null (unless already changed)
            if ($idArticle->getCategoryBlog() === $this) {
                $idArticle->setCategoryBlog(null);
            }
        }

        return $this;
    }
}
