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
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $front_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $back_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrontId(): ?int
    {
        return $this->front_id;
    }

    public function setFrontId(int $front_id): self
    {
        $this->front_id = $front_id;

        return $this;
    }

    public function getBackId(): ?int
    {
        return $this->back_id;
    }

    public function setBackId(int $back_id): self
    {
        $this->back_id = $back_id;

        return $this;
    }
}
