<?php

namespace App\Entity;

use App\Repository\ParagraphRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParagraphRepository::class)
 */
class Paragraph
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="paragraphs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity=ParagraphImage::class, mappedBy="paragrah", orphanRemoval=true)
     */
    private $paragraphImages;

    public function __construct()
    {
        $this->paragraphImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection|ParagraphImage[]
     */
    public function getParagraphImages(): Collection
    {
        return $this->paragraphImages;
    }

    public function addParagraphImage(ParagraphImage $paragraphImage): self
    {
        if (!$this->paragraphImages->contains($paragraphImage)) {
            $this->paragraphImages[] = $paragraphImage;
            $paragraphImage->setParagrah($this);
        }

        return $this;
    }

    public function removeParagraphImage(ParagraphImage $paragraphImage): self
    {
        if ($this->paragraphImages->removeElement($paragraphImage)) {
            // set the owning side to null (unless already changed)
            if ($paragraphImage->getParagrah() === $this) {
                $paragraphImage->setParagrah(null);
            }
        }

        return $this;
    }
}
