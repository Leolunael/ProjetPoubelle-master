import { useState, useEffect } from 'react';
import api from '../services/api';
import questionsData from '../../data/questions.json';

const QuizDechets = ({ userId }) => {
    const [questions, setQuestions] = useState(questionsData);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    // ... autres states

    useEffect(() => {
        const fetchQuestions = async () => {
            try {
                setLoading(true);
                const response = await api.get('/api/quiz/questions');
                setQuestions(response.data);
            } catch (err) {
                setError('Erreur lors du chargement des questions');
                console.error('Erreur:', err);
            } finally {
                setLoading(false);
            }
        };

        fetchQuestions();
    }, []);

    if (loading) {
        return (
            <div className="d-flex justify-content-center align-items-center" style={{ minHeight: '100vh' }}>
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Chargement des questions...</span>
                </div>
            </div>
        );
    }

    if (error) {
        return (
            <div className="container mt-5">
                <div className="alert alert-danger text-center">
                    <h4>Erreur</h4>
                    <p>{error}</p>
                    <button className="btn btn-primary" onClick={() => window.location.reload()}>
                        Réessayer
                    </button>
                </div>
            </div>
        );
    }

    // Reste du composant...
};
// Dans handleNextQuestion :
await api.post('/api/quiz/answer', {
    questionId: questions[currentQuestion].id,
    selectedAnswer: selectedAnswer,
    isCorrect: isCorrect,
    userId: userId // Récupéré depuis les props ou le contexte
});

// Dans saveQuizResults :
await api.post('/api/quiz/complete', {
    score: score,
    totalQuestions: questions.length,
    answers: answers,
    userId: userId,
    completedAt: new Date().toISOString()
});