<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_city`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CityRepository")
 */
class City
{
    /**
     * @var int|null $cityId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`city_id`")
     */
    protected $cityId;

    /**
     * @var int|null $zoneId
     * @ORM\Column(type="integer", name="`zone_id`")
     */
    protected $zoneId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=128)
     */
    protected $name;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status = 1;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=32)
     */
    protected $code;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder = 0;

    /**
     * @return int|null
     */
    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    /**
     * @param int|null $cityId
     * @return City
     */
    public function setCityId(?int $cityId): self
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getZoneId(): ?int
    {
        return $this->zoneId;
    }

    /**
     * @param int|null $zoneId
     * @return City
     */
    public function setZoneId(?int $zoneId): self
    {
        $this->zoneId = $zoneId;

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
     * @param string|null $name
     * @return City
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool|null $status
     * @return City
     */
    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return City
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

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
     * @return City
     */
    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}