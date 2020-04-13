<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_simple_fields`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerSimpleFieldsRepository")
 */
class CustomerSimpleFields extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`metadata`", length=255, nullable=true)
     */
    private $metadata;

    /**
     * @param int $customerId
     * @param string $metadata
     */
    public function fill(
        int $customerId,
        string $metadata
    )
    {
        $this->id = $customerId;
        $this->metadata = $metadata;
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

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }
}
