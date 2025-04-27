import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000',
    timeout: 5000,
});

interface Thread {
    id: number;
    title: string;
}

const HomePage: React.FC = () => {
    const [threads, setThreads] = useState<Thread[]>([]);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        setLoading(true);
        api.get<Thread[]>('/api/threads')
            .then((response) => {
                setThreads(response.data as Thread[]);
                setError(null);
            })
            .catch((err) => {
                console.error("API Error:", err);
                setError(`Failed to load threads: ${err.message}`);
            })
    }, []);

    return (
        <div className="container mt-4">
            <h1>Forum Threads</h1>

            {loading && <p>Loading threads...</p>}

            {error && (
                <div className="alert alert-danger">
                    {error}
                </div>
            )}

            {!loading && !error && threads.length === 0 && (
                <p>No threads found. Be the first to create one!</p>
            )}

            <div className="list-group mt-3">
                {threads.map((thread) => (
                    <Link
                        key={thread.id}
                        to={`/threads/${thread.id}`}
                        className="list-group-item list-group-item-action"
                    >
                        {thread.title}
                    </Link>
                ))}
            </div>
        </div>
    );
};

export default HomePage;
