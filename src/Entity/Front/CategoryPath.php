<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_category_path`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CategoryPathRepository")
 */
class CategoryPath extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`category_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`path_id`")
     */
    private $pathId;

    /**
     * @ORM\Column(type="integer", name="`level`")
     */
    private $level;

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
        $this->id = $categoryId;
        $this->pathId = $pathId;
        $this->level = $level;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
