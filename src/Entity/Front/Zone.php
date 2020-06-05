<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_zone`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ZoneRepository")
 */
class Zone
{
    /**
     * @var int|null $zoneId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`zone_id`")
     */
    protected $zoneId;

    /**
     * @var int|null $countryId
     * @ORM\Column(type="integer", name="`country_id`")
     */
    protected $countryId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=128)
     */
    protected $name;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=32)
     */
    protected $code;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status;

    /**
     * @return int|null
     */
    public function getZoneId(): ?int
    {
        return $this->zoneId;
    }

    /**
     * @return int|null
     */
    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     * @return Zone
     */
    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

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
     * @return Zone
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @param string $code
     * @return Zone
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

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
     * @param bool $status
     * @return Zone
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
