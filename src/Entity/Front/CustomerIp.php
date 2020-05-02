<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_ip`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerIpRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerIp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_ip_id`")
     */
    protected $customerIpId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @param int $customerId
     * @param string $ip
     */
    public function fill(
        int $customerId,
        string $ip
    )
    {
        $this->customerId = $customerId;
        $this->ip = $ip;
    }

    public function getCustomerIpId(): ?int
    {
        return $this->customerIpId;
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

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

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
