<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups_show_prices`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsShowPricesRepository")
 */
class BuyersGroupsShowPrices extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`group_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`group_id_show_price`")
     */
    private $groupIdShowPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
