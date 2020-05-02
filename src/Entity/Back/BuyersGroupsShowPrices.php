<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups_show_prices`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsShowPricesRepository")
 */
class BuyersGroupsShowPrices
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`group_id`")
     */
    protected $groupId;

    /**
     * @ORM\Column(type="integer", name="`group_id_show_price`")
     */
    protected $groupIdShowPrice;

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getGroupIdShowPrice(): ?int
    {
        return $this->groupIdShowPrice;
    }

    public function setGroupIdShowPrice(int $groupIdShowPrice): self
    {
        $this->groupIdShowPrice = $groupIdShowPrice;

        return $this;
    }
}
