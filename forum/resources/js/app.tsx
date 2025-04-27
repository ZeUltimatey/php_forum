import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import HomePage from './pages/HomePage';
import ThreadPage from './pages/ThreadPage';

const App: React.FC = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="/threads/:id" element={<ThreadPage />} />
            </Routes>
        </Router>
    );
};

export default App;
