<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_options_values`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductOptionsValuesRepository")
 */
class ProductOptionsValues extends Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`optionID`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`option_value`", length=255, nullable=true)
     */
    private $optionValue = null;

    /**
     * @ORM\Column(type="boolean", name="`option_type`", nullable=true)
     */
    private $optionType = false;

    /**
     * @ORM\Column(type="integer", name="`option_show_times`", nullable=true)
     */
    private $optionShowTimes = 1;

    /**
     * @ORM\Column(type="integer", name="`variantID`", nullable=true)
     */
    private $variantId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
