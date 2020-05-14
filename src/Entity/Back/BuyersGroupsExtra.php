<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups_extra`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsExtraRepository")
 */
class BuyersGroupsExtra
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return BuyersGroupsExtra
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return BuyersGroupsExtra
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
