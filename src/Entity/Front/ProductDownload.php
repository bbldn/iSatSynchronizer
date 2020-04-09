<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_to_download`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductDownloadRepository")
 */
class ProductDownload extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`download_id`")
     */
    private $downloadId;

    /**
     * @param int $productId
     * @param int $downloadId
     */
    public function fill(
        int $productId,
        int $downloadId
    )
    {
        $this->productId = $productId;
        $this->downloadId = $downloadId;
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

    public function getDownloadId(): ?int
    {
        return $this->downloadId;
    }

    public function setDownloadId(int $downloadId): self
    {
        $this->downloadId = $downloadId;

        return $this;
    }
}
