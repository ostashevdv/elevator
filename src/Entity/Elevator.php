<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElevatorRepository")
 */
class Elevator
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
    private $currentFloor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMoving;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="elevator")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ElevatorLog", mappedBy="elevator", orphanRemoval=true)
     */
    private $elevatorLogs;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->elevatorLogs = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCurrentFloor(): ?int
    {
        return $this->currentFloor;
    }

    public function setCurrentFloor(int $currentFloor): self
    {
        $this->currentFloor = $currentFloor;

        return $this;
    }

    public function getIsMoving(): ?bool
    {
        return $this->isMoving;
    }

    public function setIsMoving(bool $isMoving): self
    {
        $this->isMoving = $isMoving;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setElevator($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getElevator() === $this) {
                $order->setElevator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ElevatorLog[]
     */
    public function getElevatorLogs(): Collection
    {
        return $this->elevatorLogs;
    }

    public function addElevatorLog(ElevatorLog $elevatorLog): self
    {
        if (!$this->elevatorLogs->contains($elevatorLog)) {
            $this->elevatorLogs[] = $elevatorLog;
            $elevatorLog->setElevator($this);
        }

        return $this;
    }

    public function removeElevatorLog(ElevatorLog $elevatorLog): self
    {
        if ($this->elevatorLogs->contains($elevatorLog)) {
            $this->elevatorLogs->removeElement($elevatorLog);
            // set the owning side to null (unless already changed)
            if ($elevatorLog->getElevator() === $this) {
                $elevatorLog->setElevator(null);
            }
        }

        return $this;
    }
}
