<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`urls`")
 * @ORM\Entity(repositoryClass="App\Repository\URLRepository")
 */
class URL
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`front_id`", nullable=true)
     */
    private $frontId;

    /**
     * @ORM\Column(type="integer", name="`back_id`", nullable=true)
     */
    private $backId;

    /**
     * @ORM\Column(type="string")
     */
    private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrontId(): ?int
    {
        return $this->frontId;
    }

    public function setFrontId(int $frontId): self
    {
        $this->frontId = $frontId;

        return $this;
    }

    public function getBackId(): ?int
    {
        return $this->backId;
    }

    public function setBackId(int $backId): self
    {
        $this->backId = $backId;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
