<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_reward`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRewardRepository")
 */
class ProductReward extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_reward_id`")
     */
    private $productRewardId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId = 0;

    /**
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId = 0;

    /**
     * @ORM\Column(type="integer", name="`points`")
     */
    private $points = 0;

    /**
     * @param int $productId
     * @param int $customerGroupId
     * @param int $points
     */
    public function fill(
        int $productId,
        int $customerGroupId,
        int $points
    )
    {
        $this->productId = $productId;
        $this->customerGroupId = $customerGroupId;
        $this->points = $points;
    }

    public function getProductRewardId(): ?int
    {
        return $this->productRewardId;
    }

    public function setProductRewardId(int $productRewardId): self
    {
        $this->productRewardId = $productRewardId;

        return $this;
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

    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
