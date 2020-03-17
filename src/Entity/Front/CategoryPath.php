<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_path`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryPathRepository")
 */
class CategoryPath
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="integer", name="`path_id`")
     */
    private $pathId;

    /**
     * @ORM\Column(type="integer", name="`level`")
     */
    private $level;

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getPathId(): ?int
    {
        return $this->pathId;
    }

    public function setPathId(int $pathId): self
    {
        $this->pathId = $pathId;

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
