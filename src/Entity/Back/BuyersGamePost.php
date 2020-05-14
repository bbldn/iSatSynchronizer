<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_buyers_gamepost`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\BuyersGamePostRepository")
 */
class BuyersGamePost
{
    /**
     * @var int|null $id
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    protected $id;

    /**
     * @var string|null $login
     * @ORM\Column(type="string", name="`login`", length=255)
     */
    protected $login;

    /**
     * @var string|null $password
     * @ORM\Column(type="string", name="`password`", length=255)
     */
    protected $password;

    /**
     * @var string|null $fio
     * @ORM\Column(type="string", name="`fio`", length=255)
     */
    protected $fio;

    /**
     * @var string|null $phone
     * @ORM\Column(type="string", name="`phone`", length=255)
     */
    protected $phone;

    /**
     * @var string|null $region
     * @ORM\Column(type="string", name="`region`", length=255)
     */
    protected $region;

    /**
     * @var string|null $city
     * @ORM\Column(type="string", name="`city`", length=255)
     */
    protected $city;

    /**
     * @var string|null $street
     * @ORM\Column(type="string", name="`street`", length=255)
     */
    protected $street;

    /**
     * @var string|null $house
     * @ORM\Column(type="string", name="`house`", length=255)
     */
    protected $house;

    /**
     * @var string|null $mail
     * @ORM\Column(type="string", name="`mail`", length=255)
     */
    protected $mail;

    /**
     * @var string|null $code
     * @ORM\Column(type="string", name="`code`", length=255)
     */
    protected $code;

    /**
     * @var bool|null $active
     * @ORM\Column(type="boolean", name="`active`")
     */
    protected $active;

    /**
     * @var bool|null $account
     * @ORM\Column(type="boolean", name="`account`")
     */
    protected $account;

    /**
     * @var int|null $dateReg
     * @ORM\Column(type="integer", name="`date_reg`")
     */
    protected $dateReg;

    /**
     * @var int|null $dateAccBegin
     * @ORM\Column(type="integer", name="`date_acc_begin`")
     */
    protected $dateAccBegin;

    /**
     * @var int|null $dateAccEnd
     * @ORM\Column(type="integer", name="`date_acc_end`")
     */
    protected $dateAccEnd;

    /**
     * @var string|null $vip
     * @ORM\Column(type="string", name="`vip`", length=255)
     */
    protected $vip;

    /**
     * @var string|null $imageSmall
     * @ORM\Column(type="string", name="`image_small`", length=255)
     */
    protected $imageSmall;

    /**
     * @var string|null $imageBig
     * @ORM\Column(type="string", name="`image_big`", length=255)
     */
    protected $imageBig;

    /**
     * @var string|null $info
     * @ORM\Column(type="string", name="`info`", length=255)
     */
    protected $info;

    /**
     * @var string|null $ip
     * @ORM\Column(type="string", name="`ip`", length=250)
     */
    protected $ip;

    /**
     * @var string|null $timestampOnline
     * @ORM\Column(type="string", name="`timestamp_online`", length=255)
     */
    protected $timestampOnline;

    /**
     * @var string|null $timestampActive
     * @ORM\Column(type="string", name="`timestamp_active`", length=255)
     */
    protected $timestampActive;

    /**
     * @var string|null $chatNameColor
     * @ORM\Column(type="string", name="`chatname_color`", length=6)
     */
    protected $chatNameColor = '006084';

    /**
     * @var int|null $moneyReal
     * @ORM\Column(type="integer", name="`money_real`")
     */
    protected $moneyReal;

    /**
     * @var int|null $moneyVirtual
     * @ORM\Column(type="integer", name="`money_virtual`")
     */
    protected $moneyVirtual;

    /**
     * @var int|null $moneyBox
     * @ORM\Column(type="integer", name="`money_box`")
     */
    protected $moneyBox;

    /**
     * @var DateTimeInterface|null $dateBirth
     * @ORM\Column(type="datetime", name="`date_birth`")
     */
    protected $dateBirth;

    /**
     * @var int|null $referer
     * @ORM\Column(type="integer", name="`referer`")
     */
    protected $referer;

    /**
     * @var int|null $groupId
     * @ORM\Column(type="integer", name="`group_id`")
     */
    protected $groupId;

    /**
     * @var int|null $groupExtraId
     * @ORM\Column(type="integer", name="`group_extra_id`")
     */
    protected $groupExtraId = 1;

    /**
     * @var int|null $shopId
     * @ORM\Column(type="integer", name="`shop_id`")
     */
    protected $shopId = 1;

    /**
     * @var string|null $comment
     * @ORM\Column(type="string", name="`comment`", length=255)
     */
    protected $comment;

    /**
     * @var int|null $delivery
     * @ORM\Column(type="integer", name="`delivery`")
     */
    protected $delivery;

    /**
     * @var int|null $payment
     * @ORM\Column(type="integer", name="`payment`")
     */
    protected $payment;

    /**
     * @var string|null $warehouse
     * @ORM\Column(type="string", name="`warehouse`", length=255)
     */
    protected $warehouse;

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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return BuyersGamePost
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return BuyersGamePost
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFio(): ?string
    {
        return $this->fio;
    }

    /**
     * @param string $fio
     * @return BuyersGamePost
     */
    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return BuyersGamePost
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return BuyersGamePost
     */
    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return BuyersGamePost
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return BuyersGamePost
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @param string $house
     * @return BuyersGamePost
     */
    public function setHouse(string $house): self
    {
        $this->house = $house;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return BuyersGamePost
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return BuyersGamePost
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return BuyersGamePost
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAccount(): ?bool
    {
        return $this->account;
    }

    /**
     * @param bool $account
     * @return BuyersGamePost
     */
    public function setAccount(bool $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDateReg(): ?int
    {
        return $this->dateReg;
    }

    /**
     * @param int $dateReg
     * @return BuyersGamePost
     */
    public function setDateReg(int $dateReg): self
    {
        $this->dateReg = $dateReg;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDateAccBegin(): ?int
    {
        return $this->dateAccBegin;
    }

    /**
     * @param int $dateAccBegin
     * @return BuyersGamePost
     */
    public function setDateAccBegin(int $dateAccBegin): self
    {
        $this->dateAccBegin = $dateAccBegin;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDateAccEnd(): ?int
    {
        return $this->dateAccEnd;
    }

    /**
     * @param int $dateAccEnd
     * @return BuyersGamePost
     */
    public function setDateAccEnd(int $dateAccEnd): self
    {
        $this->dateAccEnd = $dateAccEnd;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVip(): ?string
    {
        return $this->vip;
    }

    /**
     * @param string $vip
     * @return BuyersGamePost
     */
    public function setVip(string $vip): self
    {
        $this->vip = $vip;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageSmall(): ?string
    {
        return $this->imageSmall;
    }

    /**
     * @param string $imageSmall
     * @return BuyersGamePost
     */
    public function setImageSmall(string $imageSmall): self
    {
        $this->imageSmall = $imageSmall;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageBig(): ?string
    {
        return $this->imageBig;
    }

    /**
     * @param string $imageBig
     * @return BuyersGamePost
     */
    public function setImageBig(string $imageBig): self
    {
        $this->imageBig = $imageBig;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string $info
     * @return BuyersGamePost
     */
    public function setInfo(string $info): self
    {
        $this->info = $info;

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
     * @return BuyersGamePost
     */
    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTimestampOnline(): ?string
    {
        return $this->timestampOnline;
    }

    /**
     * @param string $timestampOnline
     * @return BuyersGamePost
     */
    public function setTimestampOnline(string $timestampOnline): self
    {
        $this->timestampOnline = $timestampOnline;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTimestampActive(): ?string
    {
        return $this->timestampActive;
    }

    /**
     * @param string $timestampActive
     * @return BuyersGamePost
     */
    public function setTimestampActive(string $timestampActive): self
    {
        $this->timestampActive = $timestampActive;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChatNameColor(): ?string
    {
        return $this->chatNameColor;
    }

    /**
     * @param string $chatNameColor
     * @return BuyersGamePost
     */
    public function setChatNameColor(string $chatNameColor): self
    {
        $this->chatNameColor = $chatNameColor;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMoneyReal(): ?int
    {
        return $this->moneyReal;
    }

    /**
     * @param int $moneyReal
     * @return BuyersGamePost
     */
    public function setMoneyReal(int $moneyReal): self
    {
        $this->moneyReal = $moneyReal;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMoneyVirtual(): ?int
    {
        return $this->moneyVirtual;
    }

    /**
     * @param int $moneyVirtual
     * @return BuyersGamePost
     */
    public function setMoneyVirtual(int $moneyVirtual): self
    {
        $this->moneyVirtual = $moneyVirtual;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMoneyBox(): ?int
    {
        return $this->moneyBox;
    }

    /**
     * @param int $moneyBox
     * @return BuyersGamePost
     */
    public function setMoneyBox(int $moneyBox): self
    {
        $this->moneyBox = $moneyBox;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    /**
     * @param DateTimeInterface $dateBirth
     * @return BuyersGamePost
     */
    public function setDateBirth(\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReferer(): ?int
    {
        return $this->referer;
    }

    /**
     * @param int $referer
     * @return BuyersGamePost
     */
    public function setReferer(int $referer): self
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return BuyersGamePost
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupExtraId(): ?int
    {
        return $this->groupExtraId;
    }

    /**
     * @param int $groupExtraId
     * @return BuyersGamePost
     */
    public function setGroupExtraId(int $groupExtraId): self
    {
        $this->groupExtraId = $groupExtraId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     * @return BuyersGamePost
     */
    public function setShopId(int $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return BuyersGamePost
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDelivery(): ?int
    {
        return $this->delivery;
    }

    /**
     * @param int $delivery
     * @return BuyersGamePost
     */
    public function setDelivery(int $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPayment(): ?int
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     * @return BuyersGamePost
     */
    public function setPayment(int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    /**
     * @param string $warehouse
     * @return BuyersGamePost
     */
    public function setWarehouse(string $warehouse): self
    {
        $this->warehouse = $warehouse;

        return $this;
    }
}
