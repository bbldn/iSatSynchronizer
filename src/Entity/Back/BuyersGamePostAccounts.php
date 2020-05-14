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
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var string|null $accountName
     * @ORM\Column(type="string", name="`account_name`", length=255)
     */
    protected $accountName;

    /**
     * @var int|null $accountTime
     * @ORM\Column(type="integer", name="`account_time`")
     */
    protected $accountTime;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     * @return BuyersGamePostAccounts
     */
    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAccountTime(): ?int
    {
        return $this->accountTime;
    }

    /**
     * @param int $accountTime
     * @return BuyersGamePostAccounts
     */
    public function setAccountTime(int $accountTime): self
    {
        $this->accountTime = $accountTime;

        return $this;
    }
}
