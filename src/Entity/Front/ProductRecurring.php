<?php

namespace App\Entity\Front;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRecurringRepository")
 */
class ProductRecurring extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`recurring_id`")
     */
    private $recurringId;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId;

    /**
     * @param int $recurringId
     * @param int $customerGroupId
     */
    public function fill(
        int $recurringId,
        int $customerGroupId
    )
    {
        $this->recurringId = $recurringId;
        $this->customerGroupId = $customerGroupId;
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

    public function getRecurringId(): ?int
    {
        return $this->recurringId;
    }

    public function setRecurringId(int $recurringId): self
    {
        $this->recurringId = $recurringId;

        return $this;
    }

    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }
}
