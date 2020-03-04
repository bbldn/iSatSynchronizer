<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="SS_categories")
 * @ORM\Entity(repositoryClass="App\Repository\Back\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="categoryID")
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parent = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $products_count = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description = null;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $picture = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $products_count_admin = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort_order = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $viewed_times = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $allow_products_comparison = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $allow_products_search = 1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $show_subcategories_products = 1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meta_description = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meta_keywords = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $big_image = null;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $big_image_width;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $big_image_height;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link_from_big_image = null;

    /**
     * @ORM\Column(type="integer")
     */
    private $columns = 5;

    /**
     * @ORM\Column(type="integer")
     */
    private $rows = 10;

    /**
     * @ORM\Column(type="integer")
     */
    private $height = 380;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;

    /**
     * @ORM\Column(type="integer")
     */
    private $kol_products_on_showcase = 10;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = true;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $swf;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $swf_width;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $swf_height;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enable_sale = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brands;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $h1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

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
        return $this->products_count;
    }

    public function setProductsCount(int $products_count): self
    {
        $this->products_count = $products_count;

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
        return $this->products_count_admin;
    }

    public function setProductsCountAdmin(int $products_count_admin): self
    {
        $this->products_count_admin = $products_count_admin;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sort_order;
    }

    public function setSortOrder(int $sort_order): self
    {
        $this->sort_order = $sort_order;

        return $this;
    }

    public function getViewedTimes(): ?int
    {
        return $this->viewed_times;
    }

    public function setViewedTimes(int $viewed_times): self
    {
        $this->viewed_times = $viewed_times;

        return $this;
    }

    public function getAllowProductsComparison(): ?int
    {
        return $this->allow_products_comparison;
    }

    public function setAllowProductsComparison(int $allow_products_comparison): self
    {
        $this->allow_products_comparison = $allow_products_comparison;

        return $this;
    }

    public function getAllowProductsSearch(): ?int
    {
        return $this->allow_products_search;
    }

    public function setAllowProductsSearch(int $allow_products_search): self
    {
        $this->allow_products_search = $allow_products_search;

        return $this;
    }

    public function getShowSubcategoriesProducts(): ?int
    {
        return $this->show_subcategories_products;
    }

    public function setShowSubcategoriesProducts(int $show_subcategories_products): self
    {
        $this->show_subcategories_products = $show_subcategories_products;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): self
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->meta_keywords;
    }

    public function setMetaKeywords(string $meta_keywords): self
    {
        $this->meta_keywords = $meta_keywords;

        return $this;
    }

    public function getBigImage(): ?string
    {
        return $this->big_image;
    }

    public function setBigImage(string $big_image): self
    {
        $this->big_image = $big_image;

        return $this;
    }

    public function getBigImageWidth(): ?string
    {
        return $this->big_image_width;
    }

    public function setBigImageWidth(string $big_image_width): self
    {
        $this->big_image_width = $big_image_width;

        return $this;
    }

    public function getBigImageHeight(): ?string
    {
        return $this->big_image_height;
    }

    public function setBigImageHeight(string $big_image_height): self
    {
        $this->big_image_height = $big_image_height;

        return $this;
    }

    public function getLinkFromBigImage(): ?string
    {
        return $this->link_from_big_image;
    }

    public function setLinkFromBigImage(string $link_from_big_image): self
    {
        $this->link_from_big_image = $link_from_big_image;

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
        return $this->kol_products_on_showcase;
    }

    public function setKolProductsOnShowcase(int $kol_products_on_showcase): self
    {
        $this->kol_products_on_showcase = $kol_products_on_showcase;

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
        return $this->swf_width;
    }

    public function setSwfWidth(string $swf_width): self
    {
        $this->swf_width = $swf_width;

        return $this;
    }

    public function getSwfHeight(): ?string
    {
        return $this->swf_height;
    }

    public function setSwfHeight(string $swf_height): self
    {
        $this->swf_height = $swf_height;

        return $this;
    }

    public function getEnableSale(): ?bool
    {
        return $this->enable_sale;
    }

    public function setEnableSale(bool $enable_sale): self
    {
        $this->enable_sale = $enable_sale;

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
