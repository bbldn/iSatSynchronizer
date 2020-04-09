<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_group`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerGroupRepository")
 */
class CustomerGroup extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    private $customerGroupId;

    /**
     * @ORM\Column(type="boolean", name="`approval`")
     */
    private $approval;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder;

    /**
     * @param bool $approval
     * @param int $sortOrder
     */
    public function fill(
        bool $approval,
        int $sortOrder
    )
    {
        $this->approval = $approval;
        $this->sortOrder = $sortOrder;
    }


    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    public function setCustomerGroupId(int $customerGroupId): self
    {
        $this->customerGroupId = $customerGroupId;

        return $this;
    }

    public function getApproval(): ?bool
    {
        return $this->approval;
    }

    public function setApproval(bool $approval): self
    {
        $this->approval = $approval;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
