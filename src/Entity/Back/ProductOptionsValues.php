<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_options_values`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductOptionsValuesRepository")
 */
class ProductOptionsValues
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`optionID`")
     */
    protected $optionId;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="string", name="`option_value`", length=255, nullable=true)
     */
    protected $optionValue = null;

    /**
     * @ORM\Column(type="boolean", name="`option_type`", nullable=true)
     */
    protected $optionType = false;

    /**
     * @ORM\Column(type="integer", name="`option_show_times`", nullable=true)
     */
    protected $optionShowTimes = 1;

    /**
     * @ORM\Column(type="integer", name="`variantID`", nullable=true)
     */
    protected $variantId = null;

    public function getOptionId(): ?int
    {
        return $this->optionId;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getOptionValue(): ?string
    {
        return $this->optionValue;
    }

    public function setOptionValue(string $optionValue): self
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    public function getOptionType(): ?bool
    {
        return $this->optionType;
    }

    public function setOptionType(?bool $optionType): self
    {
        $this->optionType = $optionType;

        return $this;
    }

    public function getOptionShowTimes(): ?int
    {
        return $this->optionShowTimes;
    }

    public function setOptionShowTimes(?int $optionShowTimes): self
    {
        $this->optionShowTimes = $optionShowTimes;

        return $this;
    }

    public function getVariantId(): ?int
    {
        return $this->variantId;
    }

    public function setVariantId(?int $variantId): self
    {
        $this->variantId = $variantId;

        return $this;
    }
}
