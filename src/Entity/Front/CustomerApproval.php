<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_approval`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerApprovalRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerApproval
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_approval_id`")
     */
    protected $customerApprovalId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @ORM\Column(type="string", name="`type`", length=9)
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $customerId
     * @param string $type
     */
    public function fill(
        int $customerId,
        string $type
    )
    {
        $this->customerId = $customerId;
        $this->type = $type;
    }

    public function getCustomerApprovalId(): ?int
    {
        return $this->customerApprovalId;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
