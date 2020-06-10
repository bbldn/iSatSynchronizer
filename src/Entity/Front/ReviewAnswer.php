<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_review_answer`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ReviewAnswerRepository")
 */
class ReviewAnswer
{
    /**
     * @var int|null $reviewId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`review_id`")
     */
    protected $reviewId;

    /**
     * @var string|null $text
     * @ORM\Column(type="text", name="`text`")
     */
    protected $text;

    /**
     * @return int|null
     */
    public function getReviewId(): ?int
    {
        return $this->reviewId;
    }

    /**
     * @param int $reviewId
     * @return ReviewAnswer
     */
    public function setReviewId(int $reviewId): self
    {
        $this->reviewId = $reviewId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return ReviewAnswer
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
