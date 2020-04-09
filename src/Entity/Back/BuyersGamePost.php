<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_gamepost`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGamePostRepository")
 */
class BuyersGamePost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="`login`", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", name="`password`", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    private $fio;

    /**
     * @ORM\Column(type="string", name="`phone`", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", name="`region`", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", name="`city`", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="`street`", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", name="`house`", length=255)
     */
    private $house;

    /**
     * @ORM\Column(type="string", name="`mail`", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", name="`code`", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="boolean", name="`active`")
     */
    private $active;

    /**
     * @ORM\Column(type="boolean", name="`account`")
     */
    private $account;

    /**
     * @ORM\Column(type="integer", name="`date_reg`")
     */
    private $dateReg;

    /**
     * @ORM\Column(type="integer", name="`date_acc_begin`")
     */
    private $dateAccBegin;

    /**
     * @ORM\Column(type="integer", name="`date_acc_end`")
     */
    private $dateAccEnd;

    /**
     * @ORM\Column(type="string", name="`vip`", length=255)
     */
    private $vip;

    /**
     * @ORM\Column(type="string", name="`image_small`", length=255)
     */
    private $imageSmall;

    /**
     * @ORM\Column(type="string", name="`image_big`", length=255)
     */
    private $imageBig;

    /**
     * @ORM\Column(type="string", name="`info`", length=255)
     */
    private $info;

    /**
     * @ORM\Column(type="string", name="`ip`", length=250)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", name="`timestamp_online`", length=255)
     */
    private $timestampOnline;

    /**
     * @ORM\Column(type="string", name="`timestamp_active`", length=255)
     */
    private $timestampActive;

    /**
     * @ORM\Column(type="string", name="`chatname_color`", length=6)
     */
    private $chatNameColor = '006084';

    /**
     * @ORM\Column(type="integer", name="`money_real`")
     */
    private $moneyReal;

    /**
     * @ORM\Column(type="integer", name="`money_virtual`")
     */
    private $moneyVirtual;

    /**
     * @ORM\Column(type="integer", name="`money_box`")
     */
    private $moneyBox;

    /**
     * @ORM\Column(type="datetime", name="`date_birth`")
     */
    private $dateBirth;

    /**
     * @ORM\Column(type="integer", name="`referer`")
     */
    private $referer;

    /**
     * @ORM\Column(type="integer", name="`group_id`")
     */
    private $groupId;

    /**
     * @ORM\Column(type="integer", name="`group_extra_id`")
     */
    private $groupExtraId = 1;

    /**
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    private $shopId = 1;

    /**
     * @ORM\Column(type="string", name="`comment`", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", name="`delivery`")
     */
    private $delivery;

    /**
     * @ORM\Column(type="integer", name="`payment`")
     */
    private $payment;

    /**
     * @ORM\Column(type="string", name="`warehouse`", length=255)
     */
    private $warehouse;

    public function fill(
        string $login,
        string $password,
        string $fio,
        string $phone,
        string $region,
        string $city,
        string $street,
        string $house,
        string $mail,
        bool $code,
        bool $active,
        bool $account,
        int $dateReg,
        int $dateAccBegin,
        int $dateAccEnd,
        string $vip,
        string $imageSmall,
        string $imageBig,
        string $info,
        string $ip,
        string $timestampOnline,
        string $timestampActive,
        string $chatNameColor,
        int $moneyReal,
        int $moneyVirtual,
        int $moneyBox,
        \DateTimeInterface $dateBirth,
        int $referer,
        int $groupId,
        int $groupExtraId,
        int $shopId,
        string $comment,
        int $delivery,
        int $payment,
        string $warehouse
    )
    {
        $this->login = $login;
        $this->password = $password;
        $this->fio = $fio;
        $this->phone = $phone;
        $this->region = $region;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
        $this->mail = $mail;
        $this->code = $code;
        $this->active = $active;
        $this->account = $account;
        $this->dateReg = $dateReg;
        $this->dateAccBegin = $dateAccBegin;
        $this->dateAccEnd = $dateAccEnd;
        $this->vip = $vip;
        $this->imageSmall = $imageSmall;
        $this->imageBig = $imageBig;
        $this->info = $info;
        $this->ip = $ip;
        $this->timestampOnline = $timestampOnline;
        $this->timestampActive = $timestampActive;
        $this->chatNameColor = $chatNameColor;
        $this->moneyReal = $moneyReal;
        $this->moneyVirtual = $moneyVirtual;
        $this->moneyBox = $moneyBox;
        $this->dateBirth = $dateBirth;
        $this->referer = $referer;
        $this->groupId = $groupId;
        $this->groupExtraId = $groupExtraId;
        $this->shopId = $shopId;
        $this->comment = $comment;
        $this->delivery = $delivery;
        $this->payment = $payment;
        $this->warehouse = $warehouse;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(string $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getAccount(): ?bool
    {
        return $this->account;
    }

    public function setAccount(bool $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getDateReg(): ?int
    {
        return $this->dateReg;
    }

    public function setDateReg(int $dateReg): self
    {
        $this->dateReg = $dateReg;

        return $this;
    }

    public function getDateAccBegin(): ?int
    {
        return $this->dateAccBegin;
    }

    public function setDateAccBegin(int $dateAccBegin): self
    {
        $this->dateAccBegin = $dateAccBegin;

        return $this;
    }

    public function getDateAccEnd(): ?int
    {
        return $this->dateAccEnd;
    }

    public function setDateAccEnd(int $dateAccEnd): self
    {
        $this->dateAccEnd = $dateAccEnd;

        return $this;
    }

    public function getVip(): ?string
    {
        return $this->vip;
    }

    public function setVip(string $vip): self
    {
        $this->vip = $vip;

        return $this;
    }

    public function getImageSmall(): ?string
    {
        return $this->imageSmall;
    }

    public function setImageSmall(string $imageSmall): self
    {
        $this->imageSmall = $imageSmall;

        return $this;
    }

    public function getImageBig(): ?string
    {
        return $this->imageBig;
    }

    public function setImageBig(string $imageBig): self
    {
        $this->imageBig = $imageBig;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

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

    public function getTimestampOnline(): ?string
    {
        return $this->timestampOnline;
    }

    public function setTimestampOnline(string $timestampOnline): self
    {
        $this->timestampOnline = $timestampOnline;

        return $this;
    }

    public function getTimestampActive(): ?string
    {
        return $this->timestampActive;
    }

    public function setTimestampActive(string $timestampActive): self
    {
        $this->timestampActive = $timestampActive;

        return $this;
    }

    public function getChatNameColor(): ?string
    {
        return $this->chatNameColor;
    }

    public function setChatNameColor(string $chatNameColor): self
    {
        $this->chatNameColor = $chatNameColor;

        return $this;
    }

    public function getMoneyReal(): ?int
    {
        return $this->moneyReal;
    }

    public function setMoneyReal(int $moneyReal): self
    {
        $this->moneyReal = $moneyReal;

        return $this;
    }

    public function getMoneyVirtual(): ?int
    {
        return $this->moneyVirtual;
    }

    public function setMoneyVirtual(int $moneyVirtual): self
    {
        $this->moneyVirtual = $moneyVirtual;

        return $this;
    }

    public function getMoneyBox(): ?int
    {
        return $this->moneyBox;
    }

    public function setMoneyBox(int $moneyBox): self
    {
        $this->moneyBox = $moneyBox;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    public function getReferer(): ?int
    {
        return $this->referer;
    }

    public function setReferer(int $referer): self
    {
        $this->referer = $referer;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getGroupExtraId(): ?int
    {
        return $this->groupExtraId;
    }

    public function setGroupExtraId(int $groupExtraId): self
    {
        $this->groupExtraId = $groupExtraId;

        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): self
    {
        $this->shopId = $shopId;

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

    public function getDelivery(): ?int
    {
        return $this->delivery;
    }

    public function setDelivery(int $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getPayment(): ?int
    {
        return $this->payment;
    }

    public function setPayment(int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    public function setWarehouse(string $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }
}
