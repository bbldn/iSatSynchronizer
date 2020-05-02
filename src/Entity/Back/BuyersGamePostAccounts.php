<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_gamepost`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGamePostAccountsRepository")
 */
class BuyersGamePostAccounts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`account_name`", length=255)
     */
    private $accountName;

    /**
     * @ORM\Column(type="integer", name="`account_time`")
     */
    private $accountTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAccountTime(): ?int
    {
        return $this->accountTime;
    }

    public function setAccountTime(int $accountTime): self
    {
        $this->accountTime = $accountTime;

        return $this;
    }
}
