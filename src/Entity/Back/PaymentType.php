<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_payment_types`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\PaymentTypeRepository")
 */
class PaymentType
{
    /**
     * @var int|null $pid
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`PID`")
     */
    protected $pid;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`Name`", length=30, nullable=true)
     */
    protected $name = null;

    /**
     * @var string|null $description
     * @ORM\Column(type="string", name="`description`", nullable=true, length=255)
     */
    protected $description = null;

    /**
     * @var int|null $enabled
     * @ORM\Column(type="integer", name="`Enabled`", nullable=true)
     */
    protected $enabled = null;

    /**
     * @var int|null $calculateTax
     * @ORM\Column(type="integer", name="`calculate_tax`", nullable=true)
     */
    protected $calculateTax = null;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`", nullable=true)
     */
    protected $sortOrder = 0;

    /**
     * @var string|null $emailCommentsText
     * @ORM\Column(type="text", name="`email_comments_text`", nullable=true)
     */
    protected $emailCommentsText = null;

    /**
     * @var string|null $moduleId
     * @ORM\Column(type="integer", name="`module_id`", nullable=true)
     */
    protected $moduleId = null;

    /**
     * @return int|null
     */
    public function getPid(): ?int
    {
        return $this->pid;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return PaymentType
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return PaymentType
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEnabled(): ?int
    {
        return $this->enabled;
    }

    /**
     * @param int|null $enabled
     * @return PaymentType
     */
    public function setEnabled(?int $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCalculateTax(): ?int
    {
        return $this->calculateTax;
    }

    /**
     * @param int|null $calculateTax
     * @return PaymentType
     */
    public function setCalculateTax(?int $calculateTax): self
    {
        $this->calculateTax = $calculateTax;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int|null $sortOrder
     * @return PaymentType
     */
    public function setSortOrder(?int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCommentsText(): ?string
    {
        return $this->emailCommentsText;
    }

    /**
     * @param string|null $emailCommentsText
     * @return PaymentType
     */
    public function setEmailCommentsText(?string $emailCommentsText): self
    {
        $this->emailCommentsText = $emailCommentsText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getModuleId(): ?string
    {
        return $this->moduleId;
    }

    /**
     * @param string|null $moduleId
     * @return PaymentType
     */
    public function setModuleId(?string $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }
}
