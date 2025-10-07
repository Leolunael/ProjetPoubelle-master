<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $question = null;

    #[ORM\Column(type: 'json')]
    private array $options = [];

    #[ORM\Column]
    private ?int $correctAnswer = null;

    #[ORM\Column(length: 1000)]
    private ?string $explanation = null;

    #[ORM\Column]
    private ?int $orderIndex = null;

    #[ORM\Column(length: 100)]
    private ?string $category = null;

    #[ORM\Column]
    private ?bool $isActive = true;

    // Getters et setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function getCorrectAnswer(): ?int
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(int $correctAnswer): static
    {
        $this->correctAnswer = $correctAnswer;
        return $this;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): static
    {
        $this->explanation = $explanation;
        return $this;
    }

    public function getOrderIndex(): ?int
    {
        return $this->orderIndex;
    }

    public function setOrderIndex(int $orderIndex): static
    {
        $this->orderIndex = $orderIndex;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;
        return $this;
    }
}