<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_options_values`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductOptionsValuesRepository")
 */
class ProductOptionsValues
{
    /**
     * @var int|null $optionId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`optionID`")
     */
    protected $optionId;

    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var string|null $optionValue
     * @ORM\Column(type="string", name="`option_value`", length=255, nullable=true)
     */
    protected $optionValue = null;

    /**
     * @var bool|null $optionType
     * @ORM\Column(type="boolean", name="`option_type`", nullable=true)
     */
    protected $optionType = false;

    /**
     * @var int|null $optionShowTimes
     * @ORM\Column(type="integer", name="`option_show_times`", nullable=true)
     */
    protected $optionShowTimes = 1;

    /**
     * @var int|null $variantId
     * @ORM\Column(type="integer", name="`variantID`", nullable=true)
     */
    protected $variantId = null;

    /**
     * @return int|null
     */
    public function getOptionId(): ?int
    {
        return $this->optionId;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductOptionsValues
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOptionValue(): ?string
    {
        return $this->optionValue;
    }

    /**
     * @param string $optionValue
     * @return ProductOptionsValues
     */
    public function setOptionValue(string $optionValue): self
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getOptionType(): ?bool
    {
        return $this->optionType;
    }

    /**
     * @param bool|null $optionType
     * @return ProductOptionsValues
     */
    public function setOptionType(?bool $optionType): self
    {
        $this->optionType = $optionType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOptionShowTimes(): ?int
    {
        return $this->optionShowTimes;
    }

    /**
     * @param int|null $optionShowTimes
     * @return ProductOptionsValues
     */
    public function setOptionShowTimes(?int $optionShowTimes): self
    {
        $this->optionShowTimes = $optionShowTimes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVariantId(): ?int
    {
        return $this->variantId;
    }

    /**
     * @param int|null $variantId
     * @return ProductOptionsValues
     */
    public function setVariantId(?int $variantId): self
    {
        $this->variantId = $variantId;

        return $this;
    }
}
