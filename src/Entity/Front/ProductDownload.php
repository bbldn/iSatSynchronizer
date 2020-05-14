<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_download`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDownloadRepository")
 */
class ProductDownload
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $downloadId
     * @ORM\Column(type="integer", name="`download_id`")
     */
    protected $downloadId;

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductDownload
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDownloadId(): ?int
    {
        return $this->downloadId;
    }

    /**
     * @param int $downloadId
     * @return ProductDownload
     */
    public function setDownloadId(int $downloadId): self
    {
        $this->downloadId = $downloadId;

        return $this;
    }
}
