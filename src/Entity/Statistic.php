<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic
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
    private $ip_adress;

    /**
     * @ORM\Column(type="integer")
     */
    private $log_count;

    /**
     * @ORM\Column(type="date")
     */
    private $last_log;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIpAdress(): ?string
    {
        return $this->ip_adress;
    }

    public function setIpAdress(string $ip_adress): self
    {
        $this->ip_adress = $ip_adress;

        return $this;
    }

    public function getLogCount(): ?int
    {
        return $this->log_count;
    }

    public function setLogCount(int $log_count): self
    {
        $this->log_count = $log_count;

        return $this;
    }

    public function getLastLog(): ?\DateTimeInterface
    {
        return $this->last_log;
    }

    public function setLastLog(\DateTimeInterface $last_log): self
    {
        $this->last_log = $last_log;

        return $this;
    }
}
