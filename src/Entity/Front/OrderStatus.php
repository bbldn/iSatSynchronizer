<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_status`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderStatusRepository")
 */
class OrderStatus extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_status_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`language_id`")
     */
    private $languageId;

    /**
     * @ORM\Column(type="string", name="`name`", length=32)
     */
    private $name;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
