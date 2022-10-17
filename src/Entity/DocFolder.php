<?php

namespace App\Entity;

use App\Repository\DocFolderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocFolderRepository::class)
 */
class DocFolder
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
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @ORM\OneToMany(targetEntity=DocFile::class, mappedBy="doc_folder", orphanRemoval=true)
     */
    private $docFiles;

    public function __construct()
    {
        $this->docFiles = new ArrayCollection();
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

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return Collection|DocFile[]
     */
    public function getDocFiles(): Collection
    {
        return $this->docFiles;
    }

    public function addDocFile(DocFile $docFile): self
    {
        if (!$this->docFiles->contains($docFile)) {
            $this->docFiles[] = $docFile;
            $docFile->setDocFolder($this);
        }

        return $this;
    }

    public function removeDocFile(DocFile $docFile): self
    {
        if ($this->docFiles->removeElement($docFile)) {
            // set the owning side to null (unless already changed)
            if ($docFile->getDocFolder() === $this) {
                $docFile->setDocFolder(null);
            }
        }

        return $this;
    }
}
