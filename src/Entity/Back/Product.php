<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_products`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductRepository")
 */
class Product
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var int|null $categoryId
     * @ORM\Column(type="integer", name="`categoryID`", nullable=true)
     */
    protected $categoryId = null;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255, nullable=true)
     */
    protected $name = null;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", nullable=true)
     */
    protected $description;

    /**
     * @var string|null $description1
     * @ORM\Column(type="string", name="`description1`")
     */
    protected $description1;

    /**
     * @var float|null $customersRating
     * @ORM\Column(type="float", name="`customers_rating`")
     */
    protected $customersRating = 0;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`Price`")
     */
    protected $price = null;

    /**
     * @var float|null $priceHrn
     * @ORM\Column(type="float", name="`price_hrn`")
     */
    protected $priceHrn;

    /**
     * @var int|null $inStock
     * @ORM\Column(type="integer", name="`in_stock`", nullable=true)
     */
    protected $inStock = null;

    /**
     * @var int|null $inStock1
     * @ORM\Column(type="integer", name="`in_stock1`")
     */
    protected $inStock1;

    /**
     * @var int|null $customerVotes
     * @ORM\Column(type="integer", name="`customer_votes`", nullable=true)
     */
    protected $customerVotes = 0;

    /**
     * @var int|null $itemsSold
     * @ORM\Column(type="integer", name="`items_sold`")
     */
    protected $itemsSold = 0;

    /**
     * @var int|null $enabled
     * @ORM\Column(type="integer", name="`enabled`", nullable=true)
     */
    protected $enabled = null;

    /**
     * @var bool|null $enabled1
     * @ORM\Column(type="boolean", name="`enabled1`")
     */
    protected $enabled1 = true;

    /**
     * @var string|null $briefDescription
     * @ORM\Column(type="string", name="`brief_description`", nullable=true)
     */
    protected $briefDescription = null;

    /**
     * @var string|null $briefDescription1
     * @ORM\Column(type="string", name="`brief_description1`")
     */
    protected $briefDescription1;

    /**
     * @var float|null $listPrice
     * @ORM\Column(type="float", name="`list_price`", nullable=true)
     */
    protected $listPrice = null;

    /**
     * @var string|null $productCode
     * @ORM\Column(type="string", name="`product_code`", length=25, nullable=true)
     */
    protected $productCode = null;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var int|null $defaultPicture
     * @ORM\Column(type="integer", name="`default_picture`", nullable=true)
     */
    protected $defaultPicture = null;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`", nullable=true)
     */
    protected $dateAdded = null;

    /**
     * @var DateTimeInterface|null $dateModified
     * @ORM\Column(type="datetime", name="`date_modified`", nullable=true)
     */
    protected $dateModified = null;

    /**
     * @var int|null $viewedTimes
     * @ORM\Column(type="integer", name="`viewed_times`", nullable=true)
     */
    protected $viewedTimes = 0;

    /**
     * @var string|null $viewedTimes
     * @ORM\Column(type="string", name="`eproduct_filename`", length=255, nullable=true)
     */
    protected $eProductFilename = null;

    /**
     * @var int|null $eProductAvailableDays
     * @ORM\Column(type="integer", name="`eproduct_available_days`", nullable=true)
     */
    protected $eProductAvailableDays = 5;

    /**
     * @var int|null $eProductDownloadTimes
     * @ORM\Column(type="integer", name="`eproduct_download_times`", nullable=true)
     */
    protected $eProductDownloadTimes = 5;

    /**
     * @var int|null $weight
     * @ORM\Column(type="float", name="`weight`", nullable=true)
     */
    protected $weight = 0;

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
     * @var int|null $freeShipping
     * @ORM\Column(type="integer", name="`free_shipping`", nullable=true)
     */
    protected $freeShipping = 0;

    /**
     * @var int|null $minOrderAmount
     * @ORM\Column(type="integer", name="`min_order_amount`", nullable=true)
     */
    protected $minOrderAmount = 1;

    /**
     * @var float|null $shippingFreight
     * @ORM\Column(type="float", name="`shipping_freight`", nullable=true)
     */
    protected $shippingFreight = 0;

    /**
     * @var int|null $classId
     * @ORM\Column(type="integer", name="`classID`", nullable=true)
     */
    protected $classId = null;

    /**
     * @var float|null $pricePurchase
     * @ORM\Column(type="float", name="`Price_purchase`")
     */
    protected $pricePurchase = 0;

    /**
     * @var int|null $commentsEnabled
     * @ORM\Column(type="integer", name="`comments_enabled`")
     */
    protected $commentsEnabled = 1;

    /**
     * @var int|null $clientId
     * @ORM\Column(type="integer", name="`client_id`")
     */
    protected $clientId;

    /**
     * @var bool|null $noBonus
     * @ORM\Column(type="boolean", name="`no_bonus`")
     */
    protected $noBonus;

    /**
     * @var bool|null $showInPriceList
     * @ORM\Column(type="boolean", name="`show_in_pricelist`")
     */
    protected $showInPriceList = true;

    /**
     * @var bool|null $showInPriceList1
     * @ORM\Column(type="boolean", name="`show_in_pricelist1`")
     */
    protected $showInPriceList1;

    /**
     * @var string|null $recommendedText
     * @ORM\Column(type="string", name="`recommended_text`", length=255)
     */
    protected $recommendedText;

    /**
     * @var string|null $recommendedText1
     * @ORM\Column(type="string", name="`recommended_text1`", length=255)
     */
    protected $recommendedText1;

    /**
     * @var string|null $specialStripeText
     * @ORM\Column(type="string", name="`special_stripe_text`", length=255)
     */
    protected $specialStripeText;

    /**
     * @var string|null $specialStripeText1
     * @ORM\Column(type="string", name="`special_stripe_text1`", length=255)
     */
    protected $specialStripeText1;

    /**
     * @var string|null $specialStripeColor
     * @ORM\Column(type="string", name="`special_stripe_color`", length=7)
     */
    protected $specialStripeColor = '5BA71B';

    /**
     * @var string|null $specialStripeColor1
     * @ORM\Column(type="string", name="`special_stripe_color1`", length=7)
     */
    protected $specialStripeColor1 = '5BA71B';

    /**
     * @var string|null $specialStripeTextColor
     * @ORM\Column(type="string", name="`special_stripe_text_color`", length=7)
     */
    protected $specialStripeTextColor = 'FFFFFF';

    /**
     * @var string|null $specialStripeTextColor1
     * @ORM\Column(type="string", name="`special_stripe_text_color1`", length=7)
     */
    protected $specialStripeTextColor1 = 'FFFFFF';

    /**
     * @var string|null $productAbsentText
     * @ORM\Column(type="string", name="`product_absent_text`", length=255)
     */
    protected $productAbsentText;

    /**
     * @var string|null $productAbsentText1
     * @ORM\Column(type="string", name="`product_absent_text1`", length=255)
     */
    protected $productAbsentText1;

    /**
     * @var string|null $productAbsentColor
     * @ORM\Column(type="string", name="`product_absent_color`", length=7)
     */
    protected $productAbsentColor = '777777';

    /**
     * @var string|null $productAbsentColor1
     * @ORM\Column(type="string", name="`product_absent_color1`", length=7)
     */
    protected $productAbsentColor1 = '777777';

    /**
     * @var string|null $measure
     * @ORM\Column(type="string", name="`measure`", length=255)
     */
    protected $measure;

    /**
     * @var bool|null $discontinued
     * @ORM\Column(type="boolean", name="`discontinued`")
     */
    protected $discontinued;

    /**
     * @var string|null $preOrderText
     * @ORM\Column(type="string", name="`preorder_text`", length=255)
     */
    protected $preOrderText;

    /**
     * @var string|null $barcode
     * @ORM\Column(type="string", name="`barcode`", length=50)
     */
    protected $barcode;

    /**
     * @var string|null $serialNum
     * @ORM\Column(type="string", name="`serial_num`")
     */
    protected $serialNum;

    /**
     * @var bool|null $documentTypeDefault
     * @ORM\Column(type="boolean", name="`document_type_default`", nullable=true)
     */
    protected $documentTypeDefault = null;

    /**
     * @var string|null $warranty
     * @ORM\Column(type="string", name="`warranty`", length=255)
     */
    protected $warranty;

    /**
     * @var string|null $emailAfterCheckout
     * @ORM\Column(type="string", name="`email_after_checkout`", length=255)
     */
    protected $emailAfterCheckout;

    /**
     * @var int|null $minCount
     * @ORM\Column(type="integer", name="`min_count`")
     */
    protected $minCount = 5;

    /**
     * @var string|null $tags
     * @ORM\Column(type="string", name="`tags`")
     */
    protected $tags;

    /**
     * @var string|null $brand
     * @ORM\Column(type="string", name="`brand`", length=255)
     */
    protected $brand;

    /**
     * @var bool|null $fixPriceInHrn
     * @ORM\Column(type="boolean", name="`fix_price_in_hrn`")
     */
    protected $fixPriceInHrn;

    /**
     * @var bool|null $slug
     * @ORM\Column(type="string", name="`slug`", length=255)
     */
    protected $slug;

    /**
     * @var bool|null $agsatPriceInherit
     * @ORM\Column(type="boolean", name="`agsat_price_inherit`")
     */
    protected $agsatPriceInherit;

    /**
     * @var DateTimeInterface|null $agsatPriceUpdatedAt
     * @ORM\Column(type="datetime", name="`agsat_price_updated_at`")
     */
    protected $agsatPriceUpdatedAt;

    /**
     * Product constructor.
     * @param int|null $productId
     * @param int|null $categoryId
     * @param null|string $name
     * @param null|string $description
     * @param null|string $description1
     * @param float|null $customersRating
     * @param float|null $price
     * @param float|null $priceHrn
     * @param int|null $inStock
     * @param int|null $inStock1
     * @param int|null $customerVotes
     * @param int|null $itemsSold
     * @param int|null $enabled
     * @param bool|null $enabled1
     * @param null|string $briefDescription
     * @param null|string $briefDescription1
     * @param float|null $listPrice
     * @param null|string $productCode
     * @param int|null $sortOrder
     * @param int|null $defaultPicture
     * @param DateTimeInterface|null $dateAdded
     * @param DateTimeInterface|null $dateModified
     * @param int|null $viewedTimes
     * @param null|string $eProductFilename
     * @param int|null $eProductAvailableDays
     * @param int|null $eProductDownloadTimes
     * @param int|null $weight
     * @param null|string $metaDescription
     * @param null|string $metaKeywords
     * @param int|null $freeShipping
     * @param int|null $minOrderAmount
     * @param float|null $shippingFreight
     * @param int|null $classId
     * @param float|null $pricePurchase
     * @param int|null $commentsEnabled
     * @param int|null $clientId
     * @param bool|null $noBonus
     * @param bool|null $showInPriceList
     * @param bool|null $showInPriceList1
     * @param null|string $recommendedText
     * @param null|string $recommendedText1
     * @param null|string $specialStripeText
     * @param null|string $specialStripeText1
     * @param null|string $specialStripeColor
     * @param null|string $specialStripeColor1
     * @param null|string $specialStripeTextColor
     * @param null|string $specialStripeTextColor1
     * @param null|string $productAbsentText
     * @param null|string $productAbsentText1
     * @param null|string $productAbsentColor
     * @param null|string $productAbsentColor1
     * @param null|string $measure
     * @param bool|null $discontinued
     * @param null|string $preOrderText
     * @param null|string $barcode
     * @param null|string $serialNum
     * @param bool|null $documentTypeDefault
     * @param null|string $warranty
     * @param null|string $emailAfterCheckout
     * @param int|null $minCount
     * @param null|string $tags
     * @param null|string $brand
     * @param bool|null $fixPriceInHrn
     * @param bool|null $slug
     * @param bool|null $agsatPriceInherit
     * @param DateTimeInterface|null $agsatPriceUpdatedAt
     */
    public function __construct(
        ?int $productId = null,
        ?int $categoryId = null,
        ?string $name = null,
        ?string $description = null,
        ?string $description1 = null,
        ?float $customersRating = null,
        ?float $price = null,
        ?float $priceHrn = null,
        ?int $inStock = null,
        ?int $inStock1 = null,
        ?int $customerVotes = null,
        ?int $itemsSold = null,
        ?int $enabled = null,
        ?bool $enabled1 = null,
        ?string $briefDescription = null,
        ?string $briefDescription1 = null,
        ?float $listPrice = null,
        ?string $productCode = null,
        ?int $sortOrder = null,
        ?int $defaultPicture = null,
        ?DateTimeInterface $dateAdded = null,
        ?DateTimeInterface $dateModified = null,
        ?int $viewedTimes = null,
        ?string $eProductFilename = null,
        ?int $eProductAvailableDays = null,
        ?int $eProductDownloadTimes = null,
        ?int $weight = null,
        ?string $metaDescription = null,
        ?string $metaKeywords = null,
        ?int $freeShipping = null,
        ?int $minOrderAmount = null,
        ?float $shippingFreight = null,
        ?int $classId = null,
        ?float $pricePurchase = null,
        ?int $commentsEnabled = null,
        ?int $clientId = null,
        ?bool $noBonus = null,
        ?bool $showInPriceList = null,
        ?bool $showInPriceList1 = null,
        ?string $recommendedText = null,
        ?string $recommendedText1 = null,
        ?string $specialStripeText = null,
        ?string $specialStripeText1 = null,
        ?string $specialStripeColor = null,
        ?string $specialStripeColor1 = null,
        ?string $specialStripeTextColor = null,
        ?string $specialStripeTextColor1 = null,
        ?string $productAbsentText = null,
        ?string $productAbsentText1 = null,
        ?string $productAbsentColor = null,
        ?string $productAbsentColor1 = null,
        ?string $measure = null,
        ?bool $discontinued = null,
        ?string $preOrderText = null,
        ?string $barcode = null,
        ?string $serialNum = null,
        ?bool $documentTypeDefault = null,
        ?string $warranty = null,
        ?string $emailAfterCheckout = null,
        ?int $minCount = null,
        ?string $tags = null,
        ?string $brand = null,
        ?bool $fixPriceInHrn = null,
        ?bool $slug = null,
        ?bool $agsatPriceInherit = null,
        ?DateTimeInterface $agsatPriceUpdatedAt = null
    )
    {
        $this->productId = $productId;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->description1 = $description1;
        $this->customersRating = $customersRating;
        $this->price = $price;
        $this->priceHrn = $priceHrn;
        $this->inStock = $inStock;
        $this->inStock1 = $inStock1;
        $this->customerVotes = $customerVotes;
        $this->itemsSold = $itemsSold;
        $this->enabled = $enabled;
        $this->enabled1 = $enabled1;
        $this->briefDescription = $briefDescription;
        $this->briefDescription1 = $briefDescription1;
        $this->listPrice = $listPrice;
        $this->productCode = $productCode;
        $this->sortOrder = $sortOrder;
        $this->defaultPicture = $defaultPicture;
        $this->dateAdded = $dateAdded;
        $this->dateModified = $dateModified;
        $this->viewedTimes = $viewedTimes;
        $this->eProductFilename = $eProductFilename;
        $this->eProductAvailableDays = $eProductAvailableDays;
        $this->eProductDownloadTimes = $eProductDownloadTimes;
        $this->weight = $weight;
        $this->metaDescription = $metaDescription;
        $this->metaKeywords = $metaKeywords;
        $this->freeShipping = $freeShipping;
        $this->minOrderAmount = $minOrderAmount;
        $this->shippingFreight = $shippingFreight;
        $this->classId = $classId;
        $this->pricePurchase = $pricePurchase;
        $this->commentsEnabled = $commentsEnabled;
        $this->clientId = $clientId;
        $this->noBonus = $noBonus;
        $this->showInPriceList = $showInPriceList;
        $this->showInPriceList1 = $showInPriceList1;
        $this->recommendedText = $recommendedText;
        $this->recommendedText1 = $recommendedText1;
        $this->specialStripeText = $specialStripeText;
        $this->specialStripeText1 = $specialStripeText1;
        $this->specialStripeColor = $specialStripeColor;
        $this->specialStripeColor1 = $specialStripeColor1;
        $this->specialStripeTextColor = $specialStripeTextColor;
        $this->specialStripeTextColor1 = $specialStripeTextColor1;
        $this->productAbsentText = $productAbsentText;
        $this->productAbsentText1 = $productAbsentText1;
        $this->productAbsentColor = $productAbsentColor;
        $this->productAbsentColor1 = $productAbsentColor1;
        $this->measure = $measure;
        $this->discontinued = $discontinued;
        $this->preOrderText = $preOrderText;
        $this->barcode = $barcode;
        $this->serialNum = $serialNum;
        $this->documentTypeDefault = $documentTypeDefault;
        $this->warranty = $warranty;
        $this->emailAfterCheckout = $emailAfterCheckout;
        $this->minCount = $minCount;
        $this->tags = $tags;
        $this->brand = $brand;
        $this->fixPriceInHrn = $fixPriceInHrn;
        $this->slug = $slug;
        $this->agsatPriceInherit = $agsatPriceInherit;
        $this->agsatPriceUpdatedAt = $agsatPriceUpdatedAt;
    }


    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     * @return Product
     */
    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Product
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * @param string|null $description
     * @return Product
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    /**
     * @param string $description1
     * @return Product
     */
    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCustomersRating(): ?float
    {
        return $this->customersRating;
    }

    /**
     * @param float $customersRating
     * @return Product
     */
    public function setCustomersRating(float $customersRating): self
    {
        $this->customersRating = $customersRating;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceHrn(): ?float
    {
        return $this->priceHrn;
    }

    /**
     * @param float $priceHrn
     * @return Product
     */
    public function setPriceHrn(float $priceHrn): self
    {
        $this->priceHrn = $priceHrn;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInStock(): ?int
    {
        return $this->inStock;
    }

    /**
     * @param int|null $inStock
     * @return Product
     */
    public function setInStock(?int $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getInStock1(): ?int
    {
        return $this->inStock1;
    }

    /**
     * @param int $inStock1
     * @return Product
     */
    public function setInStock1(int $inStock1): self
    {
        $this->inStock1 = $inStock1;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerVotes(): ?int
    {
        return $this->customerVotes;
    }

    /**
     * @param int|null $customerVotes
     * @return Product
     */
    public function setCustomerVotes(?int $customerVotes): self
    {
        $this->customerVotes = $customerVotes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getItemsSold(): ?int
    {
        return $this->itemsSold;
    }

    /**
     * @param int $itemsSold
     * @return Product
     */
    public function setItemsSold(int $itemsSold): self
    {
        $this->itemsSold = $itemsSold;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    /**
     * @param int|null $enabled
     * @return Product
     */
    public function setEnabled(?int $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnabled1(): ?bool
    {
        return $this->enabled1;
    }

    /**
     * @param bool $enabled1
     * @return Product
     */
    public function setEnabled1(bool $enabled1): self
    {
        $this->enabled1 = $enabled1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBriefDescription(): ?string
    {
        return $this->briefDescription;
    }

    /**
     * @param string|null $briefDescription
     * @return Product
     */
    public function setBriefDescription(?string $briefDescription): self
    {
        $this->briefDescription = $briefDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBriefDescription1(): ?string
    {
        return $this->briefDescription1;
    }

    /**
     * @param string $briefDescription1
     * @return Product
     */
    public function setBriefDescription1(string $briefDescription1): self
    {
        $this->briefDescription1 = $briefDescription1;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getListPrice(): ?float
    {
        return $this->listPrice;
    }

    /**
     * @param float|null $listPrice
     * @return Product
     */
    public function setListPrice(?float $listPrice): self
    {
        $this->listPrice = $listPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    /**
     * @param string|null $productCode
     * @return Product
     */
    public function setProductCode(?string $productCode): self
    {
        $this->productCode = $productCode;

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
     * @param int|null $sortOrder
     * @return Product
     */
    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultPicture(): ?int
    {
        return $this->defaultPicture;
    }

    /**
     * @param int|null $defaultPicture
     * @return Product
     */
    public function setDefaultPicture(?int $defaultPicture): self
    {
        $this->defaultPicture = $defaultPicture;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface|null $dateAdded
     * @return Product
     */
    public function setDateAdded(?DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateModified(): ?DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param DateTimeInterface|null $dateModified
     * @return Product
     */
    public function setDateModified(?DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

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
     * @param int|null $viewedTimes
     * @return Product
     */
    public function setViewedTimes(?int $viewedTimes): self
    {
        $this->viewedTimes = $viewedTimes;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEProductFilename(): ?string
    {
        return $this->eProductFilename;
    }

    /**
     * @param string|null $eProductFilename
     * @return Product
     */
    public function setEProductFilename(?string $eProductFilename): self
    {
        $this->eProductFilename = $eProductFilename;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEProductAvailableDays(): ?int
    {
        return $this->eProductAvailableDays;
    }

    /**
     * @param int|null $eProductAvailableDays
     * @return Product
     */
    public function setEProductAvailableDays(?int $eProductAvailableDays): self
    {
        $this->eProductAvailableDays = $eProductAvailableDays;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEProductDownloadTimes(): ?int
    {
        return $this->eProductDownloadTimes;
    }

    /**
     * @param int|null $eProductDownloadTimes
     * @return Product
     */
    public function setEProductDownloadTimes(?int $eProductDownloadTimes): self
    {
        $this->eProductDownloadTimes = $eProductDownloadTimes;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     * @return Product
     */
    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

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
     * @param string|null $metaDescription
     * @return Product
     */
    public function setMetaDescription(?string $metaDescription): self
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
     * @param string|null $metaKeywords
     * @return Product
     */
    public function setMetaKeywords(?string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFreeShipping(): ?int
    {
        return $this->freeShipping;
    }

    /**
     * @param int|null $freeShipping
     * @return Product
     */
    public function setFreeShipping(?int $freeShipping): self
    {
        $this->freeShipping = $freeShipping;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinOrderAmount(): ?int
    {
        return $this->minOrderAmount;
    }

    /**
     * @param int|null $minOrderAmount
     * @return Product
     */
    public function setMinOrderAmount(?int $minOrderAmount): self
    {
        $this->minOrderAmount = $minOrderAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getShippingFreight(): ?float
    {
        return $this->shippingFreight;
    }

    /**
     * @param float|null $shippingFreight
     * @return Product
     */
    public function setShippingFreight(?float $shippingFreight): self
    {
        $this->shippingFreight = $shippingFreight;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClassId(): ?int
    {
        return $this->classId;
    }

    /**
     * @param int|null $classId
     * @return Product
     */
    public function setClassId(?int $classId): self
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPricePurchase(): ?float
    {
        return $this->pricePurchase;
    }

    /**
     * @param float $pricePurchase
     * @return Product
     */
    public function setPricePurchase(float $pricePurchase): self
    {
        $this->pricePurchase = $pricePurchase;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCommentsEnabled(): ?int
    {
        return $this->commentsEnabled;
    }

    /**
     * @param int $commentsEnabled
     * @return Product
     */
    public function setCommentsEnabled(int $commentsEnabled): self
    {
        $this->commentsEnabled = $commentsEnabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     * @return Product
     */
    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoBonus(): ?bool
    {
        return $this->noBonus;
    }

    /**
     * @param bool $noBonus
     * @return Product
     */
    public function setNoBonus(bool $noBonus): self
    {
        $this->noBonus = $noBonus;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowInPriceList(): ?bool
    {
        return $this->showInPriceList;
    }

    /**
     * @param bool $showInPriceList
     * @return Product
     */
    public function setShowInPriceList(bool $showInPriceList): self
    {
        $this->showInPriceList = $showInPriceList;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowInPriceList1(): ?bool
    {
        return $this->showInPriceList1;
    }

    /**
     * @param bool $showInPriceList1
     * @return Product
     */
    public function setShowInPriceList1(bool $showInPriceList1): self
    {
        $this->showInPriceList1 = $showInPriceList1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecommendedText(): ?string
    {
        return $this->recommendedText;
    }

    /**
     * @param string $recommendedText
     * @return Product
     */
    public function setRecommendedText(string $recommendedText): self
    {
        $this->recommendedText = $recommendedText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecommendedText1(): ?string
    {
        return $this->recommendedText1;
    }

    /**
     * @param string $recommendedText1
     * @return Product
     */
    public function setRecommendedText1(string $recommendedText1): self
    {
        $this->recommendedText1 = $recommendedText1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeText(): ?string
    {
        return $this->specialStripeText;
    }

    /**
     * @param string $specialStripeText
     * @return Product
     */
    public function setSpecialStripeText(string $specialStripeText): self
    {
        $this->specialStripeText = $specialStripeText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeText1(): ?string
    {
        return $this->specialStripeText1;
    }

    /**
     * @param string $specialStripeText1
     * @return Product
     */
    public function setSpecialStripeText1(string $specialStripeText1): self
    {
        $this->specialStripeText1 = $specialStripeText1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeColor(): ?string
    {
        return $this->specialStripeColor;
    }

    /**
     * @param string $specialStripeColor
     * @return Product
     */
    public function setSpecialStripeColor(string $specialStripeColor): self
    {
        $this->specialStripeColor = $specialStripeColor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeColor1(): ?string
    {
        return $this->specialStripeColor1;
    }

    /**
     * @param string $specialStripeColor1
     * @return Product
     */
    public function setSpecialStripeColor1(string $specialStripeColor1): self
    {
        $this->specialStripeColor1 = $specialStripeColor1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeTextColor(): ?string
    {
        return $this->specialStripeTextColor;
    }

    /**
     * @param string $specialStripeTextColor
     * @return Product
     */
    public function setSpecialStripeTextColor(string $specialStripeTextColor): self
    {
        $this->specialStripeTextColor = $specialStripeTextColor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSpecialStripeTextColor1(): ?string
    {
        return $this->specialStripeTextColor1;
    }

    /**
     * @param string $specialStripeTextColor1
     * @return Product
     */
    public function setSpecialStripeTextColor1(string $specialStripeTextColor1): self
    {
        $this->specialStripeTextColor1 = $specialStripeTextColor1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductAbsentText(): ?string
    {
        return $this->productAbsentText;
    }

    /**
     * @param string $productAbsentText
     * @return Product
     */
    public function setProductAbsentText(string $productAbsentText): self
    {
        $this->productAbsentText = $productAbsentText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductAbsentText1(): ?string
    {
        return $this->productAbsentText1;
    }

    /**
     * @param string $productAbsentText1
     * @return Product
     */
    public function setProductAbsentText1(string $productAbsentText1): self
    {
        $this->productAbsentText1 = $productAbsentText1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductAbsentColor(): ?string
    {
        return $this->productAbsentColor;
    }

    /**
     * @param string $productAbsentColor
     * @return Product
     */
    public function setProductAbsentColor(string $productAbsentColor): self
    {
        $this->productAbsentColor = $productAbsentColor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductAbsentColor1(): ?string
    {
        return $this->productAbsentColor1;
    }

    /**
     * @param string $productAbsentColor1
     * @return Product
     */
    public function setProductAbsentColor1(string $productAbsentColor1): self
    {
        $this->productAbsentColor1 = $productAbsentColor1;

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
     * @return Product
     */
    public function setMeasure(string $measure): self
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDiscontinued(): ?bool
    {
        return $this->discontinued;
    }

    /**
     * @param bool $discontinued
     * @return Product
     */
    public function setDiscontinued(bool $discontinued): self
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreOrderText(): ?string
    {
        return $this->preOrderText;
    }

    /**
     * @param string $preOrderText
     * @return Product
     */
    public function setPreOrderText(string $preOrderText): self
    {
        $this->preOrderText = $preOrderText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     * @return Product
     */
    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSerialNum(): ?string
    {
        return $this->serialNum;
    }

    /**
     * @param string $serialNum
     * @return Product
     */
    public function setSerialNum(string $serialNum): self
    {
        $this->serialNum = $serialNum;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDocumentTypeDefault(): ?bool
    {
        return $this->documentTypeDefault;
    }

    /**
     * @param bool|null $documentTypeDefault
     * @return Product
     */
    public function setDocumentTypeDefault(?bool $documentTypeDefault): self
    {
        $this->documentTypeDefault = $documentTypeDefault;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWarranty(): ?string
    {
        return $this->warranty;
    }

    /**
     * @param string $warranty
     * @return Product
     */
    public function setWarranty(string $warranty): self
    {
        $this->warranty = $warranty;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailAfterCheckout(): ?string
    {
        return $this->emailAfterCheckout;
    }

    /**
     * @param string $emailAfterCheckout
     * @return Product
     */
    public function setEmailAfterCheckout(string $emailAfterCheckout): self
    {
        $this->emailAfterCheckout = $emailAfterCheckout;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinCount(): ?int
    {
        return $this->minCount;
    }

    /**
     * @param int $minCount
     * @return Product
     */
    public function setMinCount(int $minCount): self
    {
        $this->minCount = $minCount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     * @return Product
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param $brand
     * @return Product
     */
    public function setBrand($brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFixPriceInHrn(): ?bool
    {
        return $this->fixPriceInHrn;
    }

    /**
     * @param bool $fixPriceInHrn
     * @return Product
     */
    public function setFixPriceInHrn(bool $fixPriceInHrn): self
    {
        $this->fixPriceInHrn = $fixPriceInHrn;

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
     * @return Product
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAgsatPriceInherit(): ?bool
    {
        return $this->agsatPriceInherit;
    }

    /**
     * @param bool $agsatPriceInherit
     * @return Product
     */
    public function setAgsatPriceInherit(bool $agsatPriceInherit): self
    {
        $this->agsatPriceInherit = $agsatPriceInherit;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getAgsatPriceUpdatedAt(): ?DateTimeInterface
    {
        return $this->agsatPriceUpdatedAt;
    }

    /**
     * @param DateTimeInterface $agsatPriceUpdatedAt
     * @return Product
     */
    public function setAgsatPriceUpdatedAt(DateTimeInterface $agsatPriceUpdatedAt): self
    {
        $this->agsatPriceUpdatedAt = $agsatPriceUpdatedAt;

        return $this;
    }
}