<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $fromStage;

    /**
     * @ORM\Column(type="integer")
     */
    private $toStage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $completedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Elevator", inversedBy="orders")
     */
    private $elevator;

    public function getId()
    {
        return $this->id;
    }

    public function getFromStage(): ?int
    {
        return $this->fromStage;
    }

    public function setFromStage(int $fromStage): self
    {
        $this->fromStage = $fromStage;

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

    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
    }

    public function setCompletedAt(\DateTimeInterface $completedAt): self
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
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
}
