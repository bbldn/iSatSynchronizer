<?php

namespace App\Entity\Back;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_categories`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CategoryRepository")
 */
class Category extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`categoryID`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`name`", length=255, nullable=true)
     */
    private $name = null;

    /**
     * @ORM\Column(type="integer", name="`parent`", nullable=true)
     */
    private $parent = null;

    /**
     * @ORM\Column(type="integer", name="`products_count`", nullable=true)
     */
    private $productsCount = null;

    /**
     * @ORM\Column(type="string", name="`description`", nullable=true)
     */
    private $description = null;

    /**
     * @ORM\Column(type="string", name="`picture`", length=30, nullable=true)
     */
    private $picture = null;

    /**
     * @ORM\Column(type="integer", name="`products_count_admin`", nullable=true)
     */
    private $productsCountAdmin = null;

    /**
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="integer", name="`viewed_times`", nullable=true)
     */
    private $viewedTimes = 0;

    /**
     * @ORM\Column(type="integer", name="`allow_products_comparison`", nullable=true)
     */
    private $allowProductsComparison = 0;

    /**
     * @ORM\Column(type="integer", name="`allow_products_search`", nullable=true)
     */
    private $allowProductsSearch = 1;

    /**
     * @ORM\Column(type="integer", name="`show_subcategories_products`", nullable=true)
     */
    private $showSubcategoriesProducts = 1;

    /**
     * @ORM\Column(type="string", name="`meta_description`", length=255, nullable=true)
     */
    private $metaDescription = null;

    /**
     * @ORM\Column(type="string", name="`meta_keywords`", length=255, nullable=true)
     */
    private $metaKeywords = null;

    /**
     * @ORM\Column(type="string", name="`big_image`", nullable=true)
     */
    private $bigImage = null;

    /**
     * @ORM\Column(type="string", name="`big_image_width`", length=25)
     */
    private $bigImageWidth;

    /**
     * @ORM\Column(type="string", name="`big_image_height`", length=25)
     */
    private $bigImageHeight;

    /**
     * @ORM\Column(type="string", name="`link_from_big_image`", nullable=true)
     */
    private $linkFromBigImage = null;

    /**
     * @ORM\Column(type="integer", name="`columns`")
     */
    private $columns = 5;

    /**
     * @ORM\Column(type="integer", name="`rows`")
     */
    private $rows = 10;

    /**
     * @ORM\Column(type="integer", name="`height`")
     */
    private $height = 380;

    /**
     * @ORM\Column(type="boolean", name="`active`")
     */
    private $active = true;

    /**
     * @ORM\Column(type="integer", name="`kol_products_on_showcase`")
     */
    private $kolProductsOnShowcase = 10;

    /**
     * @ORM\Column(type="boolean", name="`enabled`")
     */
    private $enabled = true;

    /**
     * @ORM\Column(type="string", name="`swf`", length=255)
     */
    private $swf;

    /**
     * @ORM\Column(type="string", name="`swf_width`", length=25)
     */
    private $swfWidth;

    /**
     * @ORM\Column(type="string", name="`swf_height`", length=25)
     */
    private $swfHeight;

    /**
     * @ORM\Column(type="boolean", name="`enable_sale`", nullable=true)
     */
    private $enableSale = 0;

    /**
     * @ORM\Column(type="string", name="`brands`", length=255)
     */
    private $brands;

    /**
     * @ORM\Column(type="string", name="`h1`", length=255)
     */
    private $h1;

    /**
     * @ORM\Column(type="string", name="`slug`", length=255)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getParent(): ?int
    {
        return $this->parent;
    }

    public function setParent(int $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getProductsCount(): ?int
    {
        return $this->productsCount;
    }

    public function setProductsCount(int $productsCount): self
    {
        $this->productsCount = $productsCount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getProductsCountAdmin(): ?int
    {
        return $this->productsCountAdmin;
    }

    public function setProductsCountAdmin(int $productsCountAdmin): self
    {
        $this->productsCountAdmin = $productsCountAdmin;

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

    public function getViewedTimes(): ?int
    {
        return $this->viewedTimes;
    }

    public function setViewedTimes(int $viewedTimes): self
    {
        $this->viewedTimes = $viewedTimes;

        return $this;
    }

    public function getAllowProductsComparison(): ?int
    {
        return $this->allowProductsComparison;
    }

    public function setAllowProductsComparison(int $allowProductsComparison): self
    {
        $this->allowProductsComparison = $allowProductsComparison;

        return $this;
    }

    public function getAllowProductsSearch(): ?int
    {
        return $this->allowProductsSearch;
    }

    public function setAllowProductsSearch(int $allowProductsSearch): self
    {
        $this->allowProductsSearch = $allowProductsSearch;

        return $this;
    }

    public function getShowSubcategoriesProducts(): ?int
    {
        return $this->showSubcategoriesProducts;
    }

    public function setShowSubcategoriesProducts(int $showSubcategoriesProducts): self
    {
        $this->showSubcategoriesProducts = $showSubcategoriesProducts;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    public function getBigImage(): ?string
    {
        return $this->bigImage;
    }

    public function setBigImage(string $bigImage): self
    {
        $this->bigImage = $bigImage;

        return $this;
    }

    public function getBigImageWidth(): ?string
    {
        return $this->bigImageWidth;
    }

    public function setBigImageWidth(string $bigImageWidth): self
    {
        $this->bigImageWidth = $bigImageWidth;

        return $this;
    }

    public function getBigImageHeight(): ?string
    {
        return $this->bigImageHeight;
    }

    public function setBigImageHeight(string $bigImageHeight): self
    {
        $this->bigImageHeight = $bigImageHeight;

        return $this;
    }

    public function getLinkFromBigImage(): ?string
    {
        return $this->linkFromBigImage;
    }

    public function setLinkFromBigImage(string $linkFromBigImage): self
    {
        $this->linkFromBigImage = $linkFromBigImage;

        return $this;
    }

    public function getColumns(): ?int
    {
        return $this->columns;
    }

    public function setColumns(int $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    public function getRows(): ?int
    {
        return $this->rows;
    }

    public function setRows(int $rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getKolProductsOnShowcase(): ?int
    {
        return $this->kolProductsOnShowcase;
    }

    public function setKolProductsOnShowcase(int $kolProductsOnShowcase): self
    {
        $this->kolProductsOnShowcase = $kolProductsOnShowcase;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getSwf(): ?string
    {
        return $this->swf;
    }

    public function setSwf(string $swf): self
    {
        $this->swf = $swf;

        return $this;
    }

    public function getSwfWidth(): ?string
    {
        return $this->swfWidth;
    }

    public function setSwfWidth(string $swfWidth): self
    {
        $this->swfWidth = $swfWidth;

        return $this;
    }

    public function getSwfHeight(): ?string
    {
        return $this->swfHeight;
    }

    public function setSwfHeight(string $swfHeight): self
    {
        $this->swfHeight = $swfHeight;

        return $this;
    }

    public function getEnableSale(): ?bool
    {
        return $this->enableSale;
    }

    public function setEnableSale(bool $enableSale): self
    {
        $this->enableSale = $enableSale;

        return $this;
    }

    public function getBrands(): ?string
    {
        return $this->brands;
    }

    public function setBrands(string $brands): self
    {
        $this->brands = $brands;

        return $this;
    }

    public function getH1(): ?string
    {
        return $this->h1;
    }

    public function setH1(string $h1): self
    {
        $this->h1 = $h1;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
