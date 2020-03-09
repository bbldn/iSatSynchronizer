<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="SS_products")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`productID`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`categoryID`", nullable=true)
     */
    private $categoryId = null;

    /**
     * @ORM\Column(type="string", name="`name`", length=255, nullable=true)
     */
    private $name = null;

    /**
     * @ORM\Column(type="string", name="`description`", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", name="`description1`")
     */
    private $description1;

    /**
     * @ORM\Column(type="float", name="`customers_rating`")
     */
    private $customers_rating = 0;

    /**
     * @ORM\Column(type="float", name="`Price`")
     */
    private $price = null;

    /**
     * @ORM\Column(type="float", name="`price_hrn`")
     */
    private $priceHrn;

    /**
     * @ORM\Column(type="integer", name="`in_stock`", nullable=true)
     */
    private $in_stock = null;

    /**
     * @ORM\Column(type="integer", name="`in_stock1`")
     */
    private $in_stock1;

    /**
     * @ORM\Column(type="integer", name="`customer_votes`", nullable=true)
     */
    private $customerVotes = 0;

    /**
     * @ORM\Column(type="integer", name="`items_sold`")
     */
    private $itemsSold = 0;

    /**
     * @ORM\Column(type="integer", name="`enabled`", nullable=true)
     */
    private $enabled = null;

    /**
     * @ORM\Column(type="boolean", name="`enabled1`")
     */
    private $enabled1 = true;

    /**
     * @ORM\Column(type="string", name="`brief_description`", nullable=true)
     */
    private $briefDescription = null;

    /**
     * @ORM\Column(type="string", name="`brief_description1`")
     */
    private $briefDescription1;

    /**
     * @ORM\Column(type="float", name="`list_price`", nullable=true)
     */
    private $listPrice = null;

    /**
     * @ORM\Column(type="string", name="`product_code`", length=25, nullable=true)
     */
    private $productCode = null;

    /**
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="integer", name="`default_picture`", nullable=true)
     */
    private $defaultPicture = null;

    /**
     * @ORM\Column(type="datetime", name="`date_added`", nullable=true)
     */
    private $dateAdded = null;

    /**
     * @ORM\Column(type="datetime", name="`date_modified`", nullable=true)
     */
    private $dateModified = null;

    /**
     * @ORM\Column(type="integer", name="`viewed_times`", nullable=true)
     */
    private $viewedTimes = 0;

    /**
     * @ORM\Column(type="string", name="`eproduct_filename`", length=255, nullable=true)
     */
    private $eproductFilename = null;

    /**
     * @ORM\Column(type="integer", name="`eproduct_available_days`", nullable=true)
     */
    private $eproductAvailableDays = 5;

    /**
     * @ORM\Column(type="integer", name="`eproduct_download_times`", nullable=true)
     */
    private $eproductDownloadTimes = 5;

    /**
     * @ORM\Column(type="float", name="`weight`", nullable=true)
     */
    private $weight = 0;

    /**
     * @ORM\Column(type="string", name="`meta_description`", length=255, nullable=true)
     */
    private $metaDescription = null;

    /**
     * @ORM\Column(type="string", name="`meta_keywords`", length=255, nullable=true)
     */
    private $metaKeywords = null;

    /**
     * @ORM\Column(type="integer", name="`free_shipping`", nullable=true)
     */
    private $freeShipping = 0;

    /**
     * @ORM\Column(type="integer", name="`min_order_amount`", nullable=true)
     */
    private $minOrderAmount = 1;

    /**
     * @ORM\Column(type="float", name="`shipping_freight`", nullable=true)
     */
    private $shippingFreight = 0;

    /**
     * @ORM\Column(type="integer", name="`classID`", nullable=true)
     */
    private $classId = null;

    /**
     * @ORM\Column(type="float", name="`Price_purchase`")
     */
    private $pricePurchase = 0;

    /**
     * @ORM\Column(type="integer", name="`comments_enabled`")
     */
    private $commentsEnabled = 1;

    /**
     * @ORM\Column(type="integer", name="`client_id`")
     */
    private $clientId;

    /**
     * @ORM\Column(type="boolean", name="`no_bonus`")
     */
    private $noBonus;

    /**
     * @ORM\Column(type="boolean", name="`show_in_pricelist`")
     */
    private $showInPricelist = true;

    /**
     * @ORM\Column(type="boolean", name="`show_in_pricelist1`")
     */
    private $showInPricelist1;

    /**
     * @ORM\Column(type="string", name="`recommended_text`", length=255)
     */
    private $recommendedText;

    /**
     * @ORM\Column(type="string", name="`recommended_text1`", length=255)
     */
    private $recommendedText1;

    /**
     * @ORM\Column(type="string", name="`special_stripe_text`", length=255)
     */
    private $specialStripeText;

    /**
     * @ORM\Column(type="string", name="`special_stripe_text1`", length=255)
     */
    private $specialStripeText1;

    /**
     * @ORM\Column(type="string", name="`special_stripe_color`", length=7)
     */
    private $specialStripeColor = '5BA71B';

    /**
     * @ORM\Column(type="string", name="`special_stripe_color1`", length=7)
     */
    private $specialStripeColor1 = '5BA71B';

    /**
     * @ORM\Column(type="string", name="`special_stripe_text_color`", length=7)
     */
    private $specialStripeTextColor = 'FFFFFF';

    /**
     * @ORM\Column(type="string", name="`special_stripe_text_color1`", length=7)
     */
    private $specialStripeTextColor1 = 'FFFFFF';

    /**
     * @ORM\Column(type="string", name="`product_absent_text`", length=255)
     */
    private $productAbsentText;

    /**
     * @ORM\Column(type="string", name="`product_absent_text1`", length=255)
     */
    private $productAbsentText1;

    /**
     * @ORM\Column(type="string", name="`product_absent_color`", length=7)
     */
    private $productAbsentColor = '777777';

    /**
     * @ORM\Column(type="string", name="`product_absent_color1`", length=7)
     */
    private $productAbsentColor1 = '777777';

    /**
     * @ORM\Column(type="string", name="`measure`", length=255)
     */
    private $measure;

    /**
     * @ORM\Column(type="boolean", name="`discontinued`")
     */
    private $discontinued;

    /**
     * @ORM\Column(type="string", name="`preorder_text`", length=255)
     */
    private $preorderText;

    /**
     * @ORM\Column(type="string", name="`barcode`", length=50)
     */
    private $barcode;

    /**
     * @ORM\Column(type="string", name="`serial_num`")
     */
    private $serialNum;

    /**
     * @ORM\Column(type="boolean", name="`document_type_default`", nullable=true)
     */
    private $documentTypeDefault = null;

    /**
     * @ORM\Column(type="text", name="`warranty`", length=255)
     */
    private $warranty;

    /**
     * @ORM\Column(type="text", name="`email_after_checkout`", length=255)
     */
    private $emailAfterCheckout;

    /**
     * @ORM\Column(type="integer", name="`min_count`")
     */
    private $minCount = 5;

    /**
     * @ORM\Column(type="string", name="`tags`")
     */
    private $tags;

    /**
     * @ORM\Column(type="string", name="`brand`", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="boolean", name="`fix_price_in_hrn`")
     */
    private $fixPriceInHrn;

    /**
     * @ORM\Column(type="string", name="`slug`", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", name="`agsat_price_inherit`")
     */
    private $agsatPriceInherit;

    /**
     * @ORM\Column(type="datetime", name="`agsat_price_updated_at`")
     */
    private $agsatPriceUpdatedAt;

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }

    public function getCustomersRating(): ?float
    {
        return $this->customers_rating;
    }

    public function setCustomersRating(float $customers_rating): self
    {
        $this->customers_rating = $customers_rating;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceHrn(): ?float
    {
        return $this->priceHrn;
    }

    public function setPriceHrn(float $priceHrn): self
    {
        $this->priceHrn = $priceHrn;

        return $this;
    }

    public function getInStock(): ?int
    {
        return $this->in_stock;
    }

    public function setInStock(?int $in_stock): self
    {
        $this->in_stock = $in_stock;

        return $this;
    }

    public function getInStock1(): ?int
    {
        return $this->in_stock1;
    }

    public function setInStock1(int $in_stock1): self
    {
        $this->in_stock1 = $in_stock1;

        return $this;
    }

    public function getCustomerVotes(): ?int
    {
        return $this->customerVotes;
    }

    public function setCustomerVotes(?int $customerVotes): self
    {
        $this->customerVotes = $customerVotes;

        return $this;
    }

    public function getItemsSold(): ?int
    {
        return $this->itemsSold;
    }

    public function setItemsSold(int $itemsSold): self
    {
        $this->itemsSold = $itemsSold;

        return $this;
    }

    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    public function setEnabled(?int $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled1(): ?bool
    {
        return $this->enabled1;
    }

    public function setEnabled1(bool $enabled1): self
    {
        $this->enabled1 = $enabled1;

        return $this;
    }

    public function getBriefDescription(): ?string
    {
        return $this->briefDescription;
    }

    public function setBriefDescription(?string $briefDescription): self
    {
        $this->briefDescription = $briefDescription;

        return $this;
    }

    public function getBriefDescription1(): ?string
    {
        return $this->briefDescription1;
    }

    public function setBriefDescription1(string $briefDescription1): self
    {
        $this->briefDescription1 = $briefDescription1;

        return $this;
    }

    public function getListPrice(): ?float
    {
        return $this->listPrice;
    }

    public function setListPrice(?float $listPrice): self
    {
        $this->listPrice = $listPrice;

        return $this;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(?string $productCode): self
    {
        $this->productCode = $productCode;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getDefaultPicture(): ?int
    {
        return $this->defaultPicture;
    }

    public function setDefaultPicture(?int $defaultPicture): self
    {
        $this->defaultPicture = $defaultPicture;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(?\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getViewedTimes(): ?int
    {
        return $this->viewedTimes;
    }

    public function setViewedTimes(?int $viewedTimes): self
    {
        $this->viewedTimes = $viewedTimes;

        return $this;
    }

    public function getEproductFilename(): ?string
    {
        return $this->eproductFilename;
    }

    public function setEproductFilename(?string $eproductFilename): self
    {
        $this->eproductFilename = $eproductFilename;

        return $this;
    }

    public function getEproductAvailableDays(): ?int
    {
        return $this->eproductAvailableDays;
    }

    public function setEproductAvailableDays(?int $eproductAvailableDays): self
    {
        $this->eproductAvailableDays = $eproductAvailableDays;

        return $this;
    }

    public function getEproductDownloadTimes(): ?int
    {
        return $this->eproductDownloadTimes;
    }

    public function setEproductDownloadTimes(?int $eproductDownloadTimes): self
    {
        $this->eproductDownloadTimes = $eproductDownloadTimes;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    public function getFreeShipping(): ?int
    {
        return $this->freeShipping;
    }

    public function setFreeShipping(?int $freeShipping): self
    {
        $this->freeShipping = $freeShipping;

        return $this;
    }

    public function getMinOrderAmount(): ?int
    {
        return $this->minOrderAmount;
    }

    public function setMinOrderAmount(?int $minOrderAmount): self
    {
        $this->minOrderAmount = $minOrderAmount;

        return $this;
    }

    public function getShippingFreight(): ?float
    {
        return $this->shippingFreight;
    }

    public function setShippingFreight(?float $shippingFreight): self
    {
        $this->shippingFreight = $shippingFreight;

        return $this;
    }

    public function getClassId(): ?int
    {
        return $this->classId;
    }

    public function setClassId(?int $classId): self
    {
        $this->classId = $classId;

        return $this;
    }

    public function getPricePurchase(): ?float
    {
        return $this->pricePurchase;
    }

    public function setPricePurchase(float $pricePurchase): self
    {
        $this->pricePurchase = $pricePurchase;

        return $this;
    }

    public function getCommentsEnabled(): ?int
    {
        return $this->commentsEnabled;
    }

    public function setCommentsEnabled(int $commentsEnabled): self
    {
        $this->commentsEnabled = $commentsEnabled;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getNoBonus(): ?bool
    {
        return $this->noBonus;
    }

    public function setNoBonus(bool $noBonus): self
    {
        $this->noBonus = $noBonus;

        return $this;
    }

    public function getShowInPricelist(): ?bool
    {
        return $this->showInPricelist;
    }

    public function setShowInPricelist(bool $showInPricelist): self
    {
        $this->showInPricelist = $showInPricelist;

        return $this;
    }

    public function getShowInPricelist1(): ?bool
    {
        return $this->showInPricelist1;
    }

    public function setShowInPricelist1(bool $showInPricelist1): self
    {
        $this->showInPricelist1 = $showInPricelist1;

        return $this;
    }

    public function getRecommendedText(): ?string
    {
        return $this->recommendedText;
    }

    public function setRecommendedText(string $recommendedText): self
    {
        $this->recommendedText = $recommendedText;

        return $this;
    }

    public function getRecommendedText1(): ?string
    {
        return $this->recommendedText1;
    }

    public function setRecommendedText1(string $recommendedText1): self
    {
        $this->recommendedText1 = $recommendedText1;

        return $this;
    }

    public function getSpecialStripeText(): ?string
    {
        return $this->specialStripeText;
    }

    public function setSpecialStripeText(string $specialStripeText): self
    {
        $this->specialStripeText = $specialStripeText;

        return $this;
    }

    public function getSpecialStripeText1(): ?string
    {
        return $this->specialStripeText1;
    }

    public function setSpecialStripeText1(string $specialStripeText1): self
    {
        $this->specialStripeText1 = $specialStripeText1;

        return $this;
    }

    public function getSpecialStripeColor(): ?string
    {
        return $this->specialStripeColor;
    }

    public function setSpecialStripeColor(string $specialStripeColor): self
    {
        $this->specialStripeColor = $specialStripeColor;

        return $this;
    }

    public function getSpecialStripeColor1(): ?string
    {
        return $this->specialStripeColor1;
    }

    public function setSpecialStripeColor1(string $specialStripeColor1): self
    {
        $this->specialStripeColor1 = $specialStripeColor1;

        return $this;
    }

    public function getSpecialStripeTextColor(): ?string
    {
        return $this->specialStripeTextColor;
    }

    public function setSpecialStripeTextColor(string $specialStripeTextColor): self
    {
        $this->specialStripeTextColor = $specialStripeTextColor;

        return $this;
    }

    public function getSpecialStripeTextColor1(): ?string
    {
        return $this->specialStripeTextColor1;
    }

    public function setSpecialStripeTextColor1(string $specialStripeTextColor1): self
    {
        $this->specialStripeTextColor1 = $specialStripeTextColor1;

        return $this;
    }

    public function getProductAbsentText(): ?string
    {
        return $this->productAbsentText;
    }

    public function setProductAbsentText(string $productAbsentText): self
    {
        $this->productAbsentText = $productAbsentText;

        return $this;
    }

    public function getProductAbsentText1(): ?string
    {
        return $this->productAbsentText1;
    }

    public function setProductAbsentText1(string $productAbsentText1): self
    {
        $this->productAbsentText1 = $productAbsentText1;

        return $this;
    }

    public function getProductAbsentColor(): ?string
    {
        return $this->productAbsentColor;
    }

    public function setProductAbsentColor(string $productAbsentColor): self
    {
        $this->productAbsentColor = $productAbsentColor;

        return $this;
    }

    public function getProductAbsentColor1(): ?string
    {
        return $this->productAbsentColor1;
    }

    public function setProductAbsentColor1(string $productAbsentColor1): self
    {
        $this->productAbsentColor1 = $productAbsentColor1;

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

    public function getDiscontinued(): ?bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): self
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    public function getPreorderText(): ?string
    {
        return $this->preorderText;
    }

    public function setPreorderText(string $preorderText): self
    {
        $this->preorderText = $preorderText;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getSerialNum(): ?string
    {
        return $this->serialNum;
    }

    public function setSerialNum(string $serialNum): self
    {
        $this->serialNum = $serialNum;

        return $this;
    }

    public function getDocumentTypeDefault(): ?bool
    {
        return $this->documentTypeDefault;
    }

    public function setDocumentTypeDefault(?bool $documentTypeDefault): self
    {
        $this->documentTypeDefault = $documentTypeDefault;

        return $this;
    }

    public function getWarranty(): ?string
    {
        return $this->warranty;
    }

    public function setWarranty(string $warranty): self
    {
        $this->warranty = $warranty;

        return $this;
    }

    public function getEmailAfterCheckout(): ?string
    {
        return $this->emailAfterCheckout;
    }

    public function setEmailAfterCheckout(string $emailAfterCheckout): self
    {
        $this->emailAfterCheckout = $emailAfterCheckout;

        return $this;
    }

    public function getMinCount(): ?int
    {
        return $this->minCount;
    }

    public function setMinCount(int $minCount): self
    {
        $this->minCount = $minCount;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFixPriceInHrn(): ?bool
    {
        return $this->fixPriceInHrn;
    }

    public function setFixPriceInHrn(bool $fixPriceInHrn): self
    {
        $this->fixPriceInHrn = $fixPriceInHrn;

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

    public function getAgsatPriceInherit(): ?bool
    {
        return $this->agsatPriceInherit;
    }

    public function setAgsatPriceInherit(bool $agsatPriceInherit): self
    {
        $this->agsatPriceInherit = $agsatPriceInherit;

        return $this;
    }

    public function getAgsatPriceUpdatedAt(): ?\DateTimeInterface
    {
        return $this->agsatPriceUpdatedAt;
    }

    public function setAgsatPriceUpdatedAt(\DateTimeInterface $agsatPriceUpdatedAt): self
    {
        $this->agsatPriceUpdatedAt = $agsatPriceUpdatedAt;

        return $this;
    }
}