<?php
namespace App\Entity;

use App\Repository\QuizAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizAnswerRepository::class)]
class QuizAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $questionId = null;

    #[ORM\Column]
    private ?int $selectedAnswer = null;

    #[ORM\Column]
    private ?bool $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuizAttempt $quizAttempt = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $answeredAt = null;

    public function __construct()
    {
        $this->answeredAt = new \DateTimeImmutable();
    }


}