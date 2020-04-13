<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_wishlist`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerWishListRepository")
 */
class CustomerWishList extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @param int $customerId
     * @param int $productId
     */
    public function fill(
        int $customerId,
        int $productId
    )
    {
        $this->id = $customerId;
        $this->productId = $productId;
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

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
