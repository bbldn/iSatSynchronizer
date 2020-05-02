<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_options`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductOptionsRepository")
 */
class ProductOptions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`optionID`")
     */
    protected $optionId;

    /**
     * @ORM\Column(type="string", name="`name`", nullable=true, length=50)
     */
    protected $name = null;

    /**
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @ORM\Column(type="boolean", name="`show_in_catalog`")
     */
    protected $showInCatalog = true;

    /**
     * @ORM\Column(type="boolean", name="`show_to_buyer`")
     */
    protected $showToBuyer = true;

    /**
     * @ORM\Column(type="string", name="`measure`", length=255)
     */
    protected $measure;

    public function getOptionId(): ?int
    {
        return $this->optionId;
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

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getShowInCatalog(): ?bool
    {
        return $this->showInCatalog;
    }

    public function setShowInCatalog(bool $showInCatalog): self
    {
        $this->showInCatalog = $showInCatalog;

        return $this;
    }

    public function getShowToBuyer(): ?bool
    {
        return $this->showToBuyer;
    }

    public function setShowToBuyer(bool $showToBuyer): self
    {
        $this->showToBuyer = $showToBuyer;

        return $this;
    }

    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    public function setMeasure(string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }
}
