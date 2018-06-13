<?php

namespace App\Entity;

use DateTime;
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
    private $fromFloor;

    /**
     * @ORM\Column(type="integer")
     */
    private $toFloor;

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
        $this->fromFloor = $fromStage;
        $this->toFloor = $toStage;
        $this->createdAt = $createdAt ?? new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFromFloor(): ?int
    {
        return $this->fromFloor;
    }

    public function getToFloor(): ?int
    {
        return $this->toFloor;
    }

    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
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
        $this->status = self::STATUS_AWAIT;
        $this->elevator = $elevator;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function process(): void
    {
        if (!$this->getElevator()) {
            throw new \DomainException('На заказ не назначен лифт');
        }
        $this->status = self::STATUS_STARTED;
        $this->getElevator()->move($this->fromFloor, $this->toFloor);
        $this->status = self::STATUS_FINISHED;
        $this->completedAt = new DateTime();
    }
}
