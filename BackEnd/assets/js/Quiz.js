import React from 'react';
import { createRoot } from 'react-dom/client';
import QuizDechets from './components/QuizDechets';

// Initialisation du quiz
document.addEventListener('DOMContentLoaded', () => {
    const quizContainer = document.getElementById('quiz-container');
    if (quizContainer) {
        const root = createRoot(quizContainer);

        // Récupération des données depuis les attributs data
        const userId = quizContainer.dataset.userId || 1;

        root.render(<QuizDechets userId={parseInt(userId)} />);
    }
});