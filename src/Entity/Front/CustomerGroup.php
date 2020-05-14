<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_group`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerGroupRepository")
 */
class CustomerGroup
{
    /**
     * @var int|null $customerGroupId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_group_id`")
     */
    protected $customerGroupId;

    /**
     * @var bool|null $approval
     * @ORM\Column(type="boolean", name="`approval`")
     */
    protected $approval;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    /**
     * @return int|null
     */
    public function getCustomerGroupId(): ?int
    {
        return $this->customerGroupId;
    }

    /**
     * @return bool|null
     */
    public function getApproval(): ?bool
    {
        return $this->approval;
    }

    /**
     * @param bool $approval
     * @return CustomerGroup
     */
    public function setApproval(bool $approval): self
    {
        $this->approval = $approval;

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
     * @param int $sortOrder
     * @return CustomerGroup
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
