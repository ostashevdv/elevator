<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`order`")
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    public const STATUS_NEW = 'new';

    public const STATUS_AWAIT = 'await';

    public const STATUS_STARTED = 'started';

    public const STATUS_FINISHED = 'finished';


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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $completedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_NEW;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Elevator", inversedBy="orders")
     */
    private $elevator;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Order constructor.
     * @param $fromStage
     * @param $toStage
     * @param $createdAt
     */
    public function __construct(int $fromStage, int $toStage, ?\DateTime $createdAt = null)
    {
        $this->setFromStage($fromStage)
            ->setToStage($toStage)
            ->setCreatedAt($createdAt ?? new \DateTime());
    }


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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
