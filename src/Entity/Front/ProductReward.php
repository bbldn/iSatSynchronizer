<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_reward`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRewardRepository")
 */
class ProductReward
{
    /**
     * @var int|null $productRewardId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_reward_id`")
     */
    protected $productRewardId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId = 0;

    /**
     * @var int|null $customerGroupId
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId = 0;

    /**
     * @var int|null $points
     * @ORM\Column(type="integer", name="`points`")
     */
    protected $points = 0;

    /**
     * @return int|null
     */
    public function getProductRewardId(): ?int
    {
        return $this->productRewardId;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductReward
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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
     * @return ProductReward
     */
    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return ProductReward
     */
    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
