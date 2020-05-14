<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_custom_field`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderCustomFieldRepository")
 */
class OrderCustomField
{
    /**
     * @var int|null $orderCustomFieldId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_custom_field_id`")
     */
    protected $orderCustomFieldId;

    /**
     * @var int|null $orderId
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var int|null $customFieldId
     * @ORM\Column(type="integer", name="`custom_field_id`")
     */
    protected $customFieldId;

    /**
     * @var int|null $customFieldValueId
     * @ORM\Column(type="integer", name="`custom_field_value_id`")
     */
    protected $customFieldValueId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var string|null $value
     * @ORM\Column(type="string", name="`value`")
     */
    protected $value;

    /**
     * @var string|null $type
     * @ORM\Column(type="string", name="`type`", length=32)
     */
    protected $type;

    /**
     * @var string|null $location
     * @ORM\Column(type="string", name="`location`", length=16)
     */
    protected $location;

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

    /**
     * @return int|null
     */
    public function getOrderCustomFieldId(): ?int
    {
        return $this->orderCustomFieldId;
    }

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return OrderCustomField
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomFieldId(): ?int
    {
        return $this->customFieldId;
    }

    /**
     * @param int $customFieldId
     * @return OrderCustomField
     */
    public function setCustomFieldId(int $customFieldId): self
    {
        $this->customFieldId = $customFieldId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomFieldValueId(): ?int
    {
        return $this->customFieldValueId;
    }

    /**
     * @param int $customFieldValueId
     * @return OrderCustomField
     */
    public function setCustomFieldValueId(int $customFieldValueId): self
    {
        $this->customFieldValueId = $customFieldValueId;

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
     * @return OrderCustomField
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return OrderCustomField
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return OrderCustomField
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return OrderCustomField
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
