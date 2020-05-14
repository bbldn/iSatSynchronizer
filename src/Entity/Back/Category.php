<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_categories`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CategoryRepository")
 */
class Category
{
    /**
     * @var int|null $categoryId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`categoryID`")
     */
    protected $categoryId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255, nullable=true)
     */
    protected $name = null;

    /**
     * @var int|null $parent
     * @ORM\Column(type="integer", name="`parent`", nullable=true)
     */
    protected $parent = null;

    /**
     * @var int|null $productsCount
     * @ORM\Column(type="integer", name="`products_count`", nullable=true)
     */
    protected $productsCount = null;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", nullable=true)
     */
    protected $description = null;

    /**
     * @var string|null $picture
     * @ORM\Column(type="string", name="`picture`", length=30, nullable=true)
     */
    protected $picture = null;

    /**
     * @var int|null $productsCountAdmin
     * @ORM\Column(type="integer", name="`products_count_admin`", nullable=true)
     */
    protected $productsCountAdmin = null;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var int|null $viewedTimes
     * @ORM\Column(type="integer", name="`viewed_times`", nullable=true)
     */
    protected $viewedTimes = 0;

    /**
     * @var int|null $allowProductsComparison
     * @ORM\Column(type="integer", name="`allow_products_comparison`", nullable=true)
     */
    protected $allowProductsComparison = 0;

    /**
     * @var int|null $allowProductsSearch
     * @ORM\Column(type="integer", name="`allow_products_search`", nullable=true)
     */
    protected $allowProductsSearch = 1;

    /**
     * @var int|null $showSubcategoriesProducts
     * @ORM\Column(type="integer", name="`show_subcategories_products`", nullable=true)
     */
    protected $showSubcategoriesProducts = 1;

    /**
     * @var string|null $metaDescription
     * @ORM\Column(type="string", name="`meta_description`", length=255, nullable=true)
     */
    protected $metaDescription = null;

    /**
     * @var string|null $metaKeywords
     * @ORM\Column(type="string", name="`meta_keywords`", length=255, nullable=true)
     */
    protected $metaKeywords = null;

    /**
     * @var string|null $bigImage
     * @ORM\Column(type="string", name="`big_image`", nullable=true)
     */
    protected $bigImage = null;

    /**
     * @var string|null $bigImageWidth
     * @ORM\Column(type="string", name="`big_image_width`", length=25)
     */
    protected $bigImageWidth;

    /**
     * @var string|null $bigImageHeight
     * @ORM\Column(type="string", name="`big_image_height`", length=25)
     */
    protected $bigImageHeight;

    /**
     * @var string|null $linkFromBigImage
     * @ORM\Column(type="string", name="`link_from_big_image`", nullable=true)
     */
    protected $linkFromBigImage = null;

    /**
     * @var int|null $columns
     * @ORM\Column(type="integer", name="`columns`")
     */
    protected $columns = 5;

    /**
     * @var int|null $rows
     * @ORM\Column(type="integer", name="`rows`")
     */
    protected $rows = 10;

    /**
     * @var int|null $height
     * @ORM\Column(type="integer", name="`height`")
     */
    protected $height = 380;

    /**
     * @var bool|null $active
     * @ORM\Column(type="boolean", name="`active`")
     */
    protected $active = true;

    /**
     * @var int|null $kolProductsOnShowcase
     * @ORM\Column(type="integer", name="`kol_products_on_showcase`")
     */
    protected $kolProductsOnShowcase = 10;

    /**
     * @var bool|null $enabled
     * @ORM\Column(type="boolean", name="`enabled`")
     */
    protected $enabled = true;

    /**
     * @var string|null $swf
     * @ORM\Column(type="string", name="`swf`", length=255)
     */
    protected $swf;

    /**
     * @var string|null $swfWidth
     * @ORM\Column(type="string", name="`swf_width`", length=25)
     */
    protected $swfWidth;

    /**
     * @var string|null $swfHeight
     * @ORM\Column(type="string", name="`swf_height`", length=25)
     */
    protected $swfHeight;

    /**
     * @var bool|null $enableSale
     * @ORM\Column(type="boolean", name="`enable_sale`", nullable=true)
     */
    protected $enableSale = 0;

    /**
     * @var string|null $brands
     * @ORM\Column(type="string", name="`brands`", length=255)
     */
    protected $brands;

    /**
     * @var string|null $h1
     * @ORM\Column(type="string", name="`h1`", length=255)
     */
    protected $h1;

    /**
     * @var string|null $slug
     * @ORM\Column(type="string", name="`slug`", length=255)
     */
    protected $slug;

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
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
     * @return Category
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getParent(): ?int
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     * @return Category
     */
    public function setParent(int $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductsCount(): ?int
    {
        return $this->productsCount;
    }

    /**
     * @param int $productsCount
     * @return Category
     */
    public function setProductsCount(int $productsCount): self
    {
        $this->productsCount = $productsCount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Category
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return Category
     */
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductsCountAdmin(): ?int
    {
        return $this->productsCountAdmin;
    }

    /**
     * @param int $productsCountAdmin
     * @return Category
     */
    public function setProductsCountAdmin(int $productsCountAdmin): self
    {
        $this->productsCountAdmin = $productsCountAdmin;

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
     * @return Category
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getViewedTimes(): ?int
    {
        return $this->viewedTimes;
    }

    /**
     * @param int $viewedTimes
     * @return Category
     */
    public function setViewedTimes(int $viewedTimes): self
    {
        $this->viewedTimes = $viewedTimes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAllowProductsComparison(): ?int
    {
        return $this->allowProductsComparison;
    }

    /**
     * @param int $allowProductsComparison
     * @return Category
     */
    public function setAllowProductsComparison(int $allowProductsComparison): self
    {
        $this->allowProductsComparison = $allowProductsComparison;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAllowProductsSearch(): ?int
    {
        return $this->allowProductsSearch;
    }

    /**
     * @param int $allowProductsSearch
     * @return Category
     */
    public function setAllowProductsSearch(int $allowProductsSearch): self
    {
        $this->allowProductsSearch = $allowProductsSearch;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShowSubcategoriesProducts(): ?int
    {
        return $this->showSubcategoriesProducts;
    }

    /**
     * @param int $showSubcategoriesProducts
     * @return Category
     */
    public function setShowSubcategoriesProducts(int $showSubcategoriesProducts): self
    {
        $this->showSubcategoriesProducts = $showSubcategoriesProducts;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     * @return Category
     */
    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     * @return Category
     */
    public function setMetaKeywords(string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBigImage(): ?string
    {
        return $this->bigImage;
    }

    /**
     * @param string $bigImage
     * @return Category
     */
    public function setBigImage(string $bigImage): self
    {
        $this->bigImage = $bigImage;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBigImageWidth(): ?string
    {
        return $this->bigImageWidth;
    }

    /**
     * @param string $bigImageWidth
     * @return Category
     */
    public function setBigImageWidth(string $bigImageWidth): self
    {
        $this->bigImageWidth = $bigImageWidth;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBigImageHeight(): ?string
    {
        return $this->bigImageHeight;
    }

    /**
     * @param string $bigImageHeight
     * @return Category
     */
    public function setBigImageHeight(string $bigImageHeight): self
    {
        $this->bigImageHeight = $bigImageHeight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLinkFromBigImage(): ?string
    {
        return $this->linkFromBigImage;
    }

    /**
     * @param string $linkFromBigImage
     * @return Category
     */
    public function setLinkFromBigImage(string $linkFromBigImage): self
    {
        $this->linkFromBigImage = $linkFromBigImage;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getColumns(): ?int
    {
        return $this->columns;
    }

    /**
     * @param int $columns
     * @return Category
     */
    public function setColumns(int $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRows(): ?int
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     * @return Category
     */
    public function setRows(int $rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Category
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Category
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getKolProductsOnShowcase(): ?int
    {
        return $this->kolProductsOnShowcase;
    }

    /**
     * @param int $kolProductsOnShowcase
     * @return Category
     */
    public function setKolProductsOnShowcase(int $kolProductsOnShowcase): self
    {
        $this->kolProductsOnShowcase = $kolProductsOnShowcase;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Category
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSwf(): ?string
    {
        return $this->swf;
    }

    /**
     * @param string $swf
     * @return Category
     */
    public function setSwf(string $swf): self
    {
        $this->swf = $swf;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSwfWidth(): ?string
    {
        return $this->swfWidth;
    }

    /**
     * @param string $swfWidth
     * @return Category
     */
    public function setSwfWidth(string $swfWidth): self
    {
        $this->swfWidth = $swfWidth;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSwfHeight(): ?string
    {
        return $this->swfHeight;
    }

    /**
     * @param string $swfHeight
     * @return Category
     */
    public function setSwfHeight(string $swfHeight): self
    {
        $this->swfHeight = $swfHeight;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnableSale(): ?bool
    {
        return $this->enableSale;
    }

    /**
     * @param bool $enableSale
     * @return Category
     */
    public function setEnableSale(bool $enableSale): self
    {
        $this->enableSale = $enableSale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBrands(): ?string
    {
        return $this->brands;
    }

    /**
     * @param string $brands
     * @return Category
     */
    public function setBrands(string $brands): self
    {
        $this->brands = $brands;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getH1(): ?string
    {
        return $this->h1;
    }

    /**
     * @param string $h1
     * @return Category
     */
    public function setH1(string $h1): self
    {
        $this->h1 = $h1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Category
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
