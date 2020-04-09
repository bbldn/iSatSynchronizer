<?php

namespace App\Entity\Back;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_groups`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGroupsRepository")
 */
class BuyersGroups extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float", name="`percent`")
     */
    private $percent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPercent(): ?float
    {
        return $this->percent;
    }

    public function setPercent(float $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
}
