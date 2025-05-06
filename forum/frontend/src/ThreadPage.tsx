import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000',
    timeout: 5000,
    withCredentials: true,
});

interface Thread {
    id: number;
    title: string;
    content: string;
}

const ThreadPage: React.FC = () => {
    const { id } = useParams<{ id: string }>();
    const [thread, setThread] = useState<Thread | null>(null);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        setLoading(true);
        Promise.resolve(api.get<Thread>(`/threads/${id}`))
            .then((response) => {
                setThread(response.data);
                setError(null);
            })
            .catch((err) => {
                console.error("API Error:", err);
                setError(`Failed to load thread: ${err.message}`);
            })
            .finally(() => setLoading(false));
    }, [id]);

    return (
        <div className="container mt-4">
            {loading && <p>Loading thread...</p>}

            {error && (
                <div className="alert alert-danger">
                    {error}
                </div>
            )}

            {!loading && thread && (
                <>
                    <h1>{thread.title}</h1>
                    <p>{thread.content}</p>
                </>
            )}
        </div>
    );
};

export default ThreadPage;
