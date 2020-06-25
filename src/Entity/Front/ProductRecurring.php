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
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $recurringId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`recurring_id`")
     */
    protected $recurringId;

    /**
     * @var int|null $customerGroupId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductRecurring
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRecurringId(): ?int
    {
        return $this->recurringId;
    }

    /**
     * @param int $recurringId
     * @return ProductRecurring
     */
    public function setRecurringId(int $recurringId): self
    {
        $this->recurringId = $recurringId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    /**
     * @param int $customerGroupId
     * @return ProductRecurring
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }
}
