<?php

namespace App\Event\BackToFront;

use App\Entity\Category;
use Symfony\Contracts\EventDispatcher\Event;

class CategorySynchronizedEvent extends Event
{
    /** @var Category $category */
    protected $category;

    /** @var bool $synchronizeImage */
    protected $synchronizeImage;

    /**
     * CategorySynchronizedEvent constructor.
     * @param Category $category
     * @param bool $synchronizeImage
     */
    public function __construct(Category $category, bool $synchronizeImage)
    {
        $this->category = $category;
        $this->synchronizeImage = $synchronizeImage;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return CategorySynchronizedEvent
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSynchronizeImage(): bool
    {
        return $this->synchronizeImage;
    }

    /**
     * @param bool $synchronizeImage
     * @return CategorySynchronizedEvent
     */
    public function setSynchronizeImage(bool $synchronizeImage): self
    {
        $this->synchronizeImage = $synchronizeImage;

        return $this;
    }
}