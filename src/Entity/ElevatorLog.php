<?php

namespace App\Entity;

use DateTime;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Elevator", inversedBy="elevatorLogs", cascade={"persist"})
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

    /**
     * ElevatorLog constructor.
     * @param $createdAt
     * @param $direction
     * @param $toStage
     */
    public function __construct($direction, $toStage)
    {
        $this->createdAt = new DateTime();
        $this->direction = $direction;
        $this->toStage = $toStage;
    }


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
