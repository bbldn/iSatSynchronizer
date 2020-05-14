<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_simple_fields`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerSimpleFieldsRepository")
 */
class CustomerSimpleFields
{
    /**
     * @var int|null $customerId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var string|null $metadata
     * @ORM\Column(type="string", name="`metadata`", length=255, nullable=true)
     */
    protected $metadata;

    /**
     * @param int $customerId
     * @param string $metadata
     */
    public function fill(
        int $customerId,
        string $metadata
    )
    {
        $this->customerId = $customerId;
        $this->metadata = $metadata;
    }


    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return CustomerSimpleFields
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

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
     * @param string|null $metadata
     * @return CustomerSimpleFields
     */
    public function setMetadata(?string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }
}
