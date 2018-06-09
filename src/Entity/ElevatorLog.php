<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElevatorLogRepository")
 */
class ElevatorLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Elevator", inversedBy="elevatorLogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $elevator;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $direction;

    /**
     * @ORM\Column(type="integer")
     */
    private $toStage;

    public function getId()
    {
        return $this->id;
    }

    public function getElevator(): ?Elevator
    {
        return $this->elevator;
    }

    public function setElevator(?Elevator $elevator): self
    {
        $this->elevator = $elevator;

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

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getToStage(): ?int
    {
        return $this->toStage;
    }

    public function setToStage(int $toStage): self
    {
        $this->toStage = $toStage;

        return $this;
    }
}
