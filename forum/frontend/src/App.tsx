import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './Login';
import Register from './Register';
import HomePage from './HomePage';
import ThreadPage from './ThreadPage';

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/threads/:id" element={<ThreadPage />} />
            </Routes>
        </Router>
    );
}

export default App;
