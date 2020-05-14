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
     * @var int|null $categoryId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    protected $categoryId;

    /**
     * @var int|null $pathId
     * @ORM\Column(type="integer", name="`path_id`")
     */
    protected $pathId;

    /**
     * @var int|null $level
     * @ORM\Column(type="integer", name="`level`")
     */
    protected $level;

    /**
     * @param int $categoryId
     * @param int $pathId
     * @param int $level
     */
    public function fill(
        int $categoryId,
        int $pathId,
        int $level
    )
    {
        $this->categoryId = $categoryId;
        $this->pathId = $pathId;
        $this->level = $level;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return CategoryPath
     */
    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPathId(): ?int
    {
        return $this->pathId;
    }

    /**
     * @param int $pathId
     * @return CategoryPath
     */
    public function setPathId(int $pathId): self
    {
        $this->pathId = $pathId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return CategoryPath
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
