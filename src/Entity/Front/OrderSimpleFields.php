<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_order_simple_fields`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\OrderSimpleFieldsRepository")
 */
class OrderSimpleFields extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`order_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`metadata`", length=255)
     */
    private $metadata;

    /**
     * @param int $orderId
     * @param string $metadata
     */
    public function fill(
        int $orderId,
        string $metadata
    )
    {
        $this->id = $orderId;
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

    public function setMetadata(string $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }
}
