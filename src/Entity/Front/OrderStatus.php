<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_status`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderStatusRepository")
 */
class OrderStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    private $orderStatusId;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=32)
     */
    private $name;

    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    public function setOrderStatusId(int $orderStatusId): self
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}