<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_options`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductOptionsRepository")
 */
class ProductOptions
{
    /**
     * @var int|null $optionId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`optionID`")
     */
    protected $optionId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", nullable=true, length=50)
     */
    protected $name = null;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var bool|null $showInCatalog
     * @ORM\Column(type="boolean", name="`show_in_catalog`")
     */
    protected $showInCatalog = true;

    /**
     * @var bool|null $showToBuyer
     * @ORM\Column(type="boolean", name="`show_to_buyer`")
     */
    protected $showToBuyer = true;

    /**
     * @var string|null $measure
     * @ORM\Column(type="string", name="`measure`", length=255)
     */
    protected $measure;

    /**
     * @return int|null
     */
    public function getOptionId(): ?int
    {
        return $this->optionId;
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
     * @return ProductOptions
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return ProductOptions
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowInCatalog(): ?bool
    {
        return $this->showInCatalog;
    }

    /**
     * @param bool $showInCatalog
     * @return ProductOptions
     */
    public function setShowInCatalog(bool $showInCatalog): self
    {
        $this->showInCatalog = $showInCatalog;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowToBuyer(): ?bool
    {
        return $this->showToBuyer;
    }

    /**
     * @param bool $showToBuyer
     * @return ProductOptions
     */
    public function setShowToBuyer(bool $showToBuyer): self
    {
        $this->showToBuyer = $showToBuyer;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMeasure(): ?string
    {
        return $this->measure;
    }

    /**
     * @param string $measure
     * @return ProductOptions
     */
    public function setMeasure(string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }
}
