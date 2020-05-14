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
     * @var int|null $orderStatusId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    protected $orderStatusId;

    /**
     * @var int|null $languageId
     * @ORM\Column(type="integer", name="`language_id`")
     */
    protected $languageId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=32)
     */
    protected $name;

    /**
     * @param int $languageId
     * @param string $name
     */
    public function fill(
        int $languageId,
        string $name
    )
    {
        $this->languageId = $languageId;
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getOrderStatusId(): ?int
    {
        return $this->orderStatusId;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return OrderStatus
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OrderStatus
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
