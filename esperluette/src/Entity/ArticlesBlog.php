<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesBlogRepository")
 */
class ArticlesBlog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=255, minMessage="Texte trop court")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryBlog", inversedBy="id_articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoryBlog;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommentBlog", mappedBy="id_article", orphanRemoval=true)
     */
    private $commentsBlog;

    public function __construct()
    {
        $this->commentsBlog = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategoryBlog(): ?CategoryBlog
    {
        return $this->categoryBlog;
    }

    public function setCategoryBlog(?CategoryBlog $categoryBlog): self
    {
        $this->categoryBlog = $categoryBlog;

        return $this;
    }

    /**
     * @return Collection|CommentBlog[]
     */
    public function getCommentsBlog(): Collection
    {
        return $this->commentsBlog;
    }

    public function addCommentsBlog(CommentBlog $commentsBlog): self
    {
        if (!$this->commentsBlog->contains($commentsBlog)) {
            $this->commentsBlog[] = $commentsBlog;
            $commentsBlog->setIdArticle($this);
        }

        return $this;
    }

    public function removeCommentsBlog(CommentBlog $commentsBlog): self
    {
        if ($this->commentsBlog->contains($commentsBlog)) {
            $this->commentsBlog->removeElement($commentsBlog);
            // set the owning side to null (unless already changed)
            if ($commentsBlog->getIdArticle() === $this) {
                $commentsBlog->setIdArticle(null);
            }
        }

        return $this;
    }
}
