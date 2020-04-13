<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_custom_field`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderCustomFieldRepository")
 */
class OrderCustomField extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_custom_field_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $orderId;

    /**
     * @ORM\Column(type="integer", name="`custom_field_id`")
     */
    private $customFieldId;

    /**
     * @ORM\Column(type="integer", name="`custom_field_value_id`")
     */
    private $customFieldValueId;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="`value`")
     */
    private $value;

    /**
     * @ORM\Column(type="string", name="`type`", length=32)
     */
    private $type;

    /**
     * @ORM\Column(type="string", name="`location`", length=16)
     */
    private $location;

    /**
     * @param int $orderId
     * @param int $customFieldId
     * @param int $customFieldValueId
     * @param string $name
     * @param string $value
     * @param string $type
     * @param string $location
     */
    public function fill(
        int $orderId,
        int $customFieldId,
        int $customFieldValueId,
        string $name,
        string $value,
        string $type,
        string $location
    )
    {
        $this->orderId = $orderId;
        $this->customFieldId = $customFieldId;
        $this->customFieldValueId = $customFieldValueId;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->location = $location;
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

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getCustomFieldId(): ?int
    {
        return $this->customFieldId;
    }

    public function setCustomFieldId(int $customFieldId): self
    {
        $this->customFieldId = $customFieldId;

        return $this;
    }

    public function getCustomFieldValueId(): ?int
    {
        return $this->customFieldValueId;
    }

    public function setCustomFieldValueId(int $customFieldValueId): self
    {
        $this->customFieldValueId = $customFieldValueId;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
