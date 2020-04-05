<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_activity`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerActivityRepository")
 */
class CustomerActivity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_activity_id`")
     */
    private $customerActivityId;

    /**
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    private $customerId;

    /**
     * @ORM\Column(type="string", name="`key`", length=64)
     */
    private $key;

    /**
     * @ORM\Column(type="string", name="`data`", length=255)
     */
    private $data;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    private $ip;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @param int $customerId
     * @param string $key
     * @param string $data
     * @param string $ip
     */
    public function fill(
        int $customerId,
        string $key,
        string $data,
        string $ip
    )
    {
        $this->customerId = $customerId;
        $this->key = $key;
        $this->data = $data;
        $this->ip = $ip;
    }


    public function getCustomerActivityId(): ?int
    {
        return $this->customerActivityId;
    }

    public function setCustomerActivityId(int $customerActivityId): self
    {
        $this->customerActivityId = $customerActivityId;

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

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

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
