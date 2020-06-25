<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups_show_prices`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsShowPricesRepository")
 */
class BuyersGroupsShowPrices
{
    /**
     * @var int|null $groupId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`group_id`")
     */
    protected $groupId;

    /**
     * @var int|null $groupIdShowPrice
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`group_id_show_price`")
     */
    protected $groupIdShowPrice;

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return BuyersGroupsShowPrices
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupIdShowPrice(): ?int
    {
        return $this->groupIdShowPrice;
    }

    /**
     * @param int $groupIdShowPrice
     * @return BuyersGroupsShowPrices
     */
    public function setGroupIdShowPrice(int $groupIdShowPrice): self
    {
        $this->groupIdShowPrice = $groupIdShowPrice;

        return $this;
    }
}
