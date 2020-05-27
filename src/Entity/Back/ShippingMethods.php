<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_shipping_methods`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ShippingMethodsRepository")
 */
class ShippingMethods
{
    /**
     * @var int|null $sid
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`SID`")
     */
    protected $sid;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`Name`", length=30, nullable=true)
     */
    protected $name;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string|null $emailCommentsText
     * @ORM\Column(type="text", name="`email_comments_text`", nullable=true)
     */
    protected $emailCommentsText;

    /**
     * @var int|null $enabled
     * @ORM\Column(type="integer", name="`Enabled`", nullable=true)
     */
    protected $enabled;

    /**
     * @var int|null $moduleId
     * @ORM\Column(type="integer", name="`module_id`", nullable=true)
     */
    protected $moduleId;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var string|null $warehouses
     * @ORM\Column(type="text", name="`warehouses`")
     */
    protected $warehouses;

    /**
     * @var DateTimeInterface|null $warehousesLastUpdate
     * @ORM\Column(type="datetime", name="`warehouses_last_update`")
     */
    protected $warehousesLastUpdate;

    /**
     * @var string|null $key
     * @ORM\Column(type="string", name="`key`", length=255)
     */
    protected $key;

    /**
     * @return int|null
     */
    public function getSid(): ?int
    {
        return $this->sid;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return ShippingMethods
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return ShippingMethods
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCommentsText(): ?string
    {
        return $this->emailCommentsText;
    }

    /**
     * @param string|null $emailCommentsText
     * @return ShippingMethods
     */
    public function setEmailCommentsText(?string $emailCommentsText): self
    {
        $this->emailCommentsText = $emailCommentsText;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    /**
     * @param int|null $enabled
     * @return ShippingMethods
     */
    public function setEnabled(?int $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getModuleId(): ?int
    {
        return $this->moduleId;
    }

    /**
     * @param int|null $moduleId
     * @return ShippingMethods
     */
    public function setModuleId(?int $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int|null $sortOrder
     * @return ShippingMethods
     */
    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWarehouses(): ?string
    {
        return $this->warehouses;
    }

    /**
     * @param string $warehouses
     * @return ShippingMethods
     */
    public function setWarehouses(string $warehouses): self
    {
        $this->warehouses = $warehouses;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getWarehousesLastUpdate(): ?DateTimeInterface
    {
        return $this->warehousesLastUpdate;
    }

    /**
     * @param DateTimeInterface $warehousesLastUpdate
     * @return ShippingMethods
     */
    public function setWarehousesLastUpdate(DateTimeInterface $warehousesLastUpdate): self
    {
        $this->warehousesLastUpdate = $warehousesLastUpdate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setKey(string $key)
    {
        $this->key = $key;

        return $this;
    }
}
