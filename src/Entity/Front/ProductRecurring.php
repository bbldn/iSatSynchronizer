<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_recurring`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRecurringRepository")
 */
class ProductRecurring
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

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

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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
