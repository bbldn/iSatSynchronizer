<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_category_path")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryPathRepository")
 */
class CategoryPath
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $category_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $path_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getPathId(): ?int
    {
        return $this->path_id;
    }

    public function setPathId(int $path_id): self
    {
        $this->path_id = $path_id;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
