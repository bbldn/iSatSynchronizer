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
     * @var int|null $storeId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`store_id`")
     */
    protected $storeId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    protected $name;

    /**
     * @var string|null $url
     * @ORM\Column(type="string", name="`url`", length=255)
     */
    protected $url;

    /**
     * @var string|null $ssl
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

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Store
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Store
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSsl(): ?string
    {
        return $this->ssl;
    }

    /**
     * @param string $ssl
     * @return Store
     */
    public function setSsl(string $ssl): self
    {
        $this->ssl = $ssl;

        return $this;
    }
}
