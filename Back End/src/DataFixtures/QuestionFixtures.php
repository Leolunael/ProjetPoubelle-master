<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $questionsData = [
            [
                'question' => 'Dans quelle poubelle doit-on jeter une bouteille en plastique ?',
                'options' => [
                    'Poubelle jaune (recyclage)',
                    'Poubelle verte (déchets organiques)',
                    'Poubelle noire (déchets ordinaires)',
                    'Poubelle bleue (papier)'
                ],
                'correctAnswer' => 0,
                'explanation' => 'Les bouteilles en plastique vont dans la poubelle jaune pour être recyclées !',
                'orderIndex' => 1,
                'category' => 'recyclage'
            ],
            [
                'question' => 'Que signifie le symbole avec les trois flèches qui forment un triangle ?',
                'options' => [
                    'Danger',
                    'Recyclage',
                    'Interdiction',
                    'Attention'
                ],
                'correctAnswer' => 1,
                'explanation' => 'Ce symbole indique que le produit peut être recyclé. C\'est très important pour protéger notre planète !',
                'orderIndex' => 2,
                'category' => 'symboles'
            ],
            [
                'question' => 'Combien de temps met un sac plastique à se décomposer dans la nature ?',
                'options' => [
                    '1 mois',
                    '1 an',
                    '100 à 400 ans',
                    '10 ans'
                ],
                'correctAnswer' => 2,
                'explanation' => 'Un sac plastique met entre 100 et 400 ans à se décomposer ! C\'est pourquoi il faut les recycler.',
                'orderIndex' => 3,
                'category' => 'environnement'
            ],
            [
                'question' => 'Que peut-on faire avec les déchets organiques (épluchures, restes de repas) ?',
                'options' => [
                    'Les jeter à la poubelle normale',
                    'Les brûler',
                    'Faire du compost',
                    'Les laisser par terre'
                ],
                'correctAnswer' => 2,
                'explanation' => 'Avec les déchets organiques, on peut faire du compost qui aide les plantes à pousser !',
                'orderIndex' => 4,
                'category' => 'compost'
            ],
            [
                'question' => 'Qu\'est-ce qui pollue le plus les océans ?',
                'options' => [
                    'Les poissons',
                    'Les déchets plastiques',
                    'L\'eau de pluie',
                    'Les algues'
                ],
                'correctAnswer' => 1,
                'explanation' => 'Les déchets plastiques polluent énormément les océans et font du mal aux animaux marins.',
                'orderIndex' => 5,
                'category' => 'pollution'
            ]
        ];

        foreach ($questionsData as $questionData) {
            $question = new Question();
            $question->setQuestion($questionData['question']);
            $question->setOptions($questionData['options']);
            $question->setCorrectAnswer($questionData['correctAnswer']);
            $question->setExplanation($questionData['explanation']);
            $question->setOrderIndex($questionData['orderIndex']);
            $question->setCategory($questionData['category']);
            $question->setIsActive(true);

            $manager->persist($question);
        }

        $manager->flush();
    }
}