<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_store`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\StoreRepository")
 */
class Store
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="`url`", length=255)
     */
    protected $url;

    /**
     * @ORM\Column(type="string", name="`ssl`", length=255)
     */
    protected $ssl;

    /**
     * @param $name
     * @param $url
     * @param $ssl
     */
    public function fill(
        string $name,
        string $url,
        string $ssl
    )
    {
        $this->name = $name;
        $this->url = $url;
        $this->ssl = $ssl;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getSsl(): ?string
    {
        return $this->ssl;
    }

    public function setSsl(string $ssl): self
    {
        $this->ssl = $ssl;

        return $this;
    }
}
