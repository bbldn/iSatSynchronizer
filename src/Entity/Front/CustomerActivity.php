<?php

namespace App\Entity\Front;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_activity`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerActivityRepository")
 */
class CustomerActivity
{
    /**
     * @var int|null $customerActivityId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_activity_id`")
     */
    protected $customerActivityId;

    /**
     * @var int|null $customerId
     * @ORM\Column(type="integer", name="`customer_id`")
     */
    protected $customerId;

    /**
     * @var string|null $key
     * @ORM\Column(type="string", name="`key`", length=64)
     */
    protected $key;

    /**
     * @var string|null $data
     * @ORM\Column(type="string", name="`data`", length=255)
     */
    protected $data;

    /**
     * @var string|null $ip
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

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

    /**
     * @return int|null
     */
    public function getCustomerActivityId(): ?int
    {
        return $this->customerActivityId;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     * @return CustomerActivity
     */
    public function setCustomerId(int $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return CustomerActivity
     */
    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return CustomerActivity
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return CustomerActivity
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface $dateAdded
     * @return CustomerActivity
     */
    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
