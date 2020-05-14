<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsRepository")
 */
class BuyersGroups
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
     * @var float|null $percent
     * @ORM\Column(type="float", name="`percent`")
     */
    protected $percent;

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
     * @return BuyersGroups
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPercent(): ?float
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     * @return BuyersGroups
     */
    public function setPercent(float $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
}
