<?php

namespace App\Controller;

use App\Entity\QuizAnswer;
use App\Entity\QuizAttempt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/quiz')]
class QuizController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {}

    #[Route('/answer', name: 'quiz_answer', methods: ['GET', 'POST'])]
    public function saveAnswer(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            // Validation des données
            if (!isset($data['questionId'], $data['selectedAnswer'], $data['isCorrect'], $data['userId'])) {
                return new JsonResponse(['error' => 'Données manquantes'], Response::HTTP_BAD_REQUEST);
            }

            // Ici vous pourriez ajouter une logique pour associer à une tentative en cours
            // Pour simplifier, on stocke juste la réponse temporairement en session
            $session = $request->getSession();
            $answers = $session->get('quiz_answers', []);
            $answers[] = $data;
            $session->set('quiz_answers', $answers);

            return new JsonResponse(['status' => 'success', 'message' => 'Réponse sauvegardée']);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur serveur'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/complete', name: 'quiz_complete', methods: ['POST'])]
    public function completeQuiz(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            // Validation des données
            if (!isset($data['score'], $data['totalQuestions'], $data['answers'], $data['userId'])) {
                return new JsonResponse(['error' => 'Données manquantes'], Response::HTTP_BAD_REQUEST);
            }

            // Création de la tentative de quiz
            $quizAttempt = new QuizAttempt();
            $quizAttempt->setUserId($data['userId']);
            $quizAttempt->setScore($data['score']);
            $quizAttempt->setTotalQuestions($data['totalQuestions']);

            // Ajout des réponses
            foreach ($data['answers'] as $answerData) {
                $quizAnswer = new QuizAnswer();
                $quizAnswer->setQuestionId($answerData['questionId']);
                $quizAnswer->setSelectedAnswer($answerData['selectedAnswer']);
                $quizAnswer->setIsCorrect($answerData['isCorrect']);

                $quizAttempt->addAnswer($quizAnswer);
            }

            // Validation
            $errors = $this->validator->validate($quizAttempt);
            if (count($errors) > 0) {
                return new JsonResponse(['error' => 'Données invalides'], Response::HTTP_BAD_REQUEST);
            }

            // Sauvegarde
            $this->entityManager->persist($quizAttempt);
            $this->entityManager->flush();

            // Nettoyage de la session
            $request->getSession()->remove('quiz_answers');

            return new JsonResponse([
                'status' => 'success',
                'message' => 'Quiz complété avec succès',
                'quizAttemptId' => $quizAttempt->getId()
            ]);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur serveur: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/questions', name: 'quiz_questions', methods: ['GET'])]
    public function getQuestions(): JsonResponse
    {
        $questions = $this->entityManager
            ->getRepository(Question::class)
            ->findBy(['isActive' => true], ['orderIndex' => 'ASC']);

        $questionsData = [];
        foreach ($questions as $question) {
            $questionsData[] = [
                'id' => $question->getId(),
                'question' => $question->getQuestion(),
                'options' => $question->getOptions(),
                'correctAnswer' => $question->getCorrectAnswer(),
                'explanation' => $question->getExplanation()
            ];
        }

        return new JsonResponse($questionsData);
    }
}