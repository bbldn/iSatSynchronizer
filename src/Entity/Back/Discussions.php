<?php

namespace App\Entity\Back;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_discussions`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\DiscussionsRepository")
 */
class Discussions extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`DID`")
     */
    private $did;

    /**
     * @ORM\Column(type="integer", name="`productID`", nullable=true)
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`Author`", nullable=true, length=40)
     */
    private $author;

    /**
     * @ORM\Column(type="string", name="`Body`", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", name="`add_time`", nullable=true)
     */
    private $addTime;

    /**
     * @ORM\Column(type="string", name="`Topic`", nullable=true, length=255)
     */
    private $topic;

    /**
     * @ORM\Column(type="boolean", name="`enabled`")
     */
    private $enabled;

    /**
     * @ORM\Column(type="integer", name="`stars`")
     */
    private $stars = 5;

    /**
     * @ORM\Column(type="string", name="`answer`", length=255)
     */
    private $answer;

    /**
     * @ORM\Column(type="integer", name="`site_id`")
     */
    private $siteId;

    public function fill(
        ?int $productId,
        ?string $author,
        ?string $body,
        ?\DateTimeInterface $addTime,
        ?string $topic,
        bool $enabled,
        int $stars,
        string $answer,
        int $siteId
    )
    {
        $this->productId = $productId;
        $this->author = $author;
        $this->body = $body;
        $this->addTime = $addTime;
        $this->topic = $topic;
        $this->enabled = $enabled;
        $this->stars = $stars;
        $this->answer = $answer;
        $this->siteId = $siteId;
    }


    public function getDid(): ?int
    {
        return $this->did;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAddTime(): ?\DateTimeInterface
    {
        return $this->addTime;
    }

    public function setAddTime(?\DateTimeInterface $addTime): self
    {
        $this->addTime = $addTime;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(?string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getSiteId(): ?int
    {
        return $this->siteId;
    }

    public function setSiteId(int $siteId): self
    {
        $this->siteId = $siteId;

        return $this;
    }
}
