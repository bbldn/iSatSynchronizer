<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_option`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionRepository")
 */
class ProductOption
{
    /**
     * @var int|null $productOptionId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    protected $productOptionId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $optionId
     * @ORM\Column(type="integer", name="`option_id`")
     */
    protected $optionId;

    /**
     * @var string|null $value
     * @ORM\Column(type="string", name="`value`", length=255)
     */
    protected $value;

    /**
     * @var bool|null $required
     * @ORM\Column(type="boolean", name="`required`")
     */
    protected $required;

    /**
     * @param int $productId
     * @param int $optionId
     * @param string $value
     * @param bool $required
     */
    public function fill(
        int $productId,
        int $optionId,
        string $value,
        bool $required
    )
    {
        $this->productId = $productId;
        $this->optionId = $optionId;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * @return int|null
     */
    public function getProductOptionId(): ?int
    {
        return $this->productOptionId;
    }

    /**
     * @param int $productOptionId
     * @return ProductOption
     */
    public function setProductOptionId(int $productOptionId): self
    {
        $this->productOptionId = $productOptionId;

        return $this;
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
     * @return ProductOption
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOptionId(): ?int
    {
        return $this->optionId;
    }

    /**
     * @param int $optionId
     * @return ProductOption
     */
    public function setOptionId(int $optionId): self
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return ProductOption
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRequired(): ?bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return ProductOption
     */
    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }
}
