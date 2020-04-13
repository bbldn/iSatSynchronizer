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
    private $id;

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
        $this->id = $productId;
        $this->downloadId = $downloadId;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
