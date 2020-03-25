<?php

namespace App\Other\Fillers;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;

class ProductFiller extends Filler
{
    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @param int $availableStatus
     * @param int $notAvailableStatus
     * @return ProductFront
     */
    public static function backToFront(ProductBack $productBack,
                                       ProductFront $productFront,
                                       int $availableStatus,
                                       int $notAvailableStatus)
    {
        $productFront->setModel('art' . $productBack->getProductId());
        $productFront->setSku($productBack->getProductId());
        $productFront->setUpc(Filler::securityString(null));
        $productFront->setEan(Filler::securityString(null));
        $productFront->setJan(Filler::securityString(null));
        $productFront->setIsbn(Filler::securityString(null));
        $productFront->setMpn(Filler::securityString(null));
        $productFront->setLocation(Filler::securityString(null));
        $quantity = $productBack->getInStock();
        $productFront->setQuantity($quantity);

        if ($quantity > 0) {
            $productFront->setStockStatusId($availableStatus);
        } else {
            $productFront->setStockStatusId($notAvailableStatus);
        }

        $productFront->setImage(Filler::securityString(null));
        $productFront->setManufacturerId(1);//Временно
        $productFront->setShipping(true);
        $productFront->setPrice($productBack->getPrice());
        $productFront->setPoints(0);
        $productFront->setTaxClassId(0);
        $productFront->setDateAvailable(new \DateTime('now'));
        $productFront->setWeight(0);
        $productFront->setWeightClassId(0);
        $productFront->setLength(0);
        $productFront->setWidth(0);
        $productFront->setHeight(0);
        $productFront->setLengthClassId(0);
        $productFront->setSubtract(false);
        $productFront->setMinimum(true);
        $productFront->setSortOrder(0);
        $productFront->setStatus($productBack->getEnabled() !== 0);
        $productFront->setViewed(0);

        return $productFront;
    }
}