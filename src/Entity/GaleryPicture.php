<?php

namespace App\Entity;

use App\Repository\GaleryPictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=GaleryPictureRepository::class)
 * @Vich\Uploadable
 */
class GaleryPicture
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="galery_picture", fileNameProperty="imageName", size="imageSize")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="galeryPictures")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
    /**
   * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
   * of 'UploadedFile' is injected into this setter to trigger the update. If this
   * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
   * must be able to accept an instance of 'File' as the bundle will inject one here
   * during Doctrine hydration.
   *
   * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
   */
  public function setImageFile(?File $imageFile = null): void
  {
      $this->imageFile = $imageFile;

      if (null !== $imageFile) {
          // It is required that at least one field changes if you are using doctrine
          // otherwise the event listeners won't be called and the file is lost
          $this->updatedAt = new \DateTimeImmutable();
      }
  }

  public function getImageFile(): ?File
  {
      return $this->imageFile;
  }

  public function setImageName(?string $imageName): void
  {
      $this->imageName = $imageName;
  }

  public function getImageName(): ?string
  {
      return $this->imageName;
  }

  public function setImageSize(?int $imageSize): void
  {
      $this->imageSize = $imageSize;
  }

  public function getImageSize(): ?int
  {
      return $this->imageSize;
  }

  /**
   * @return Collection|Tag[]
   */
  public function getTags(): Collection
  {
      return $this->tags;
  }

  public function addTag(Tag $tag): self
  {
      if (!$this->tags->contains($tag)) {
          $this->tags[] = $tag;
      }

      return $this;
  }

  public function removeTag(Tag $tag): self
  {
      $this->tags->removeElement($tag);

      return $this;
  }

}
