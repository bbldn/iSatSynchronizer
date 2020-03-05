<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`front_id`")
     */
    private $frontId;

    /**
     * @ORM\Column(type="integer", name="`back_id`")
     */
    private $backId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrontId(): ?int
    {
        return $this->frontId;
    }

    public function setFrontId(int $frontId): self
    {
        $this->frontId = $frontId;

        return $this;
    }

    public function getBackId(): ?int
    {
        return $this->backId;
    }

    public function setBackId(int $backId): self
    {
        $this->backId = $backId;

        return $this;
    }
}
