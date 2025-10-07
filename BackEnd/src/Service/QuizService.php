<?php

namespace App\Service;

class QuizService
{
    private array $questions;

    public function __construct()
    {
        $this->questions = [
            [
                'id' => 1,
                'question' => 'Dans quelle poubelle doit-on jeter une bouteille en plastique ?',
                'options' => [
                    'Poubelle jaune (recyclage)',
                    'Poubelle verte (déchets organiques)',
                    'Poubelle noire (déchets ordinaires)',
                    'Poubelle bleue (papier)'
                ],
                'correctAnswer' => 0,
                'explanation' => 'Les bouteilles en plastique vont dans la poubelle jaune pour être recyclées !'
            ],
            // ... autres questions
        ];
    }

    public function getAllQuestions(): array
    {
        return $this->questions;
    }

    public function getQuestionById(int $id): ?array
    {
        foreach ($this->questions as $question) {
            if ($question['id'] === $id) {
                return $question;
            }
        }
        return null;
    }

    public function validateAnswer(int $questionId, int $selectedAnswer): bool
    {
        $question = $this->getQuestionById($questionId);
        return $question && $question['correctAnswer'] === $selectedAnswer;
    }
}