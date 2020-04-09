<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_history`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerHistoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerHistory extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_history_id`")
     */
    private $customerHistoryId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", name="`comment`", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @param int $customerId
     * @param string $comment
     */
    public function fill(
        int $customerId,
        string $comment
    )
    {
        $this->customerId = $customerId;
        $this->comment = $comment;
    }

    public function getCustomerHistoryId(): ?int
    {
        return $this->customerHistoryId;
    }

    public function setCustomerHistoryId(int $customerHistoryId): self
    {
        $this->customerHistoryId = $customerHistoryId;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    /**
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
