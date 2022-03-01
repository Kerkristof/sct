<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
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
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=GaleryPicture::class, mappedBy="tags")
     */
    private $galeryPictures;

    public function __construct()
    {
        $this->galeryPictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|GaleryPicture[]
     */
    public function getGaleryPictures(): Collection
    {
        return $this->galeryPictures;
    }

    public function addGaleryPicture(GaleryPicture $galeryPicture): self
    {
        if (!$this->galeryPictures->contains($galeryPicture)) {
            $this->galeryPictures[] = $galeryPicture;
            $galeryPicture->addTag($this);
        }

        return $this;
    }

    public function removeGaleryPicture(GaleryPicture $galeryPicture): self
    {
        if ($this->galeryPictures->removeElement($galeryPicture)) {
            $galeryPicture->removeTag($this);
        }

        return $this;
    }
}
