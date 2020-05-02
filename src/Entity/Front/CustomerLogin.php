<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_customer_login`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\CustomerLoginRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CustomerLogin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`customer_login_id`")
     */
    protected $customerLoginId;

    /**
     * @ORM\Column(type="string", name="`email`", length=96)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="`ip`", length=40)
     */
    protected $ip;

    /**
     * @ORM\Column(type="integer", name="`total`")
     */
    protected $total;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * @param string $email
     * @param string $ip
     * @param int $total
     */
    public function fill(
        string $email,
        string $ip,
        int $total
    )
    {
        $this->email = $email;
        $this->ip = $ip;
        $this->total = $total;
    }

    public function getCustomerLoginId(): ?int
    {
        return $this->customerLoginId;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

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
