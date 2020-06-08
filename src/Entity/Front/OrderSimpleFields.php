<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_simple_fields`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderSimpleFieldsRepository")
 */
class OrderSimpleFields
{
    /**
     * @var int|null $orderId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    protected $orderId;

    /**
     * @var string|null $metadata
     * @ORM\Column(type="text", name="`metadata`")
     */
    protected $metadata = null;

    /**
     * @var string|null $oblast
     * @ORM\Column(type="text", name="`oblast`", nullable=true)
     */
    protected $oblast = null;

    /**
     * @var string|null $gorod
     * @ORM\Column(type="text", name="`gorod`", nullable=true)
     */
    protected $gorod = null;

    /**
     * @var string|null $otdelenie
     * @ORM\Column(type="text", name="`otdelenie`", nullable=true)
     */
    protected $otdelenie = null;

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return OrderSimpleFields
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    /**
     * @param string $metadata
     * @return OrderSimpleFields
     */
    public function setMetadata(string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOblast(): ?string
    {
        return $this->oblast;
    }

    /**
     * @param string|null $oblast
     * @return OrderSimpleFields
     */
    public function setOblast(?string $oblast): self
    {
        $this->oblast = $oblast;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGorod(): ?string
    {
        return $this->gorod;
    }

    /**
     * @param string|null $gorod
     * @return OrderSimpleFields
     */
    public function setGorod(?string $gorod): self
    {
        $this->gorod = $gorod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOtdelenie(): ?string
    {
        return $this->otdelenie;
    }

    /**
     * @param string|null $otdelenie
     * @return OrderSimpleFields
     */
    public function setOtdelenie(?string $otdelenie): self
    {
        $this->otdelenie = $otdelenie;

        return $this;
    }
}
