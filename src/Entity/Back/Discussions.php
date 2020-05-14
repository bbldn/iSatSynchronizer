<?php

namespace App\Entity\Back;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_discussions`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\DiscussionsRepository")
 */
class Discussions
{
    /**
     * @var int|null $did
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`DID`")
     */
    protected $did;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`productID`", nullable=true)
     */
    protected $productId;

    /**
     * @var string|null $author
     * @ORM\Column(type="string", name="`Author`", nullable=true, length=40)
     */
    protected $author;

    /**
     * @var string|null $body
     * @ORM\Column(type="string", name="`Body`", nullable=true)
     */
    protected $body;

    /**
     * @var DateTimeInterface|null $addTime
     * @ORM\Column(type="datetime", name="`add_time`", nullable=true)
     */
    protected $addTime;

    /**
     * @var string|null $topic
     * @ORM\Column(type="string", name="`Topic`", nullable=true, length=255)
     */
    protected $topic;

    /**
     * @var bool|null $enabled
     * @ORM\Column(type="boolean", name="`enabled`")
     */
    protected $enabled;

    /**
     * @var int|null $stars
     * @ORM\Column(type="integer", name="`stars`")
     */
    protected $stars = 5;

    /**
     * @var string|null $answer
     * @ORM\Column(type="string", name="`answer`", length=255)
     */
    protected $answer;

    /**
     * @var integer|null $siteId
     * @ORM\Column(type="integer", name="`site_id`")
     */
    protected $siteId;

    /**
     * @return int|null
     */
    public function getDid(): ?int
    {
        return $this->did;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     * @return Discussions
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return Discussions
     */
    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return Discussions
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getAddTime(): ?DateTimeInterface
    {
        return $this->addTime;
    }

    /**
     * @param DateTimeInterface|null $addTime
     * @return Discussions
     */
    public function setAddTime(?DateTimeInterface $addTime): self
    {
        $this->addTime = $addTime;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTopic(): ?string
    {
        return $this->topic;
    }

    /**
     * @param string|null $topic
     * @return Discussions
     */
    public function setTopic(?string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Discussions
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStars(): ?int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     * @return Discussions
     */
    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     * @return Discussions
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSiteId(): ?int
    {
        return $this->siteId;
    }

    /**
     * @param int $siteId
     * @return Discussions
     */
    public function setSiteId(int $siteId): self
    {
        $this->siteId = $siteId;

        return $this;
    }
}
