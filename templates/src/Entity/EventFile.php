<?php

namespace App\Entity;

use App\Repository\EventFileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventFileRepository::class)
 */
class EventFile
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
    private $file_name;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="eventFiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
      return $this->file_name;
    }

    public function setFileName(string $file_name): self
    {
      $this->file_name = $file_name;

      return $this;
    }
    
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

}
