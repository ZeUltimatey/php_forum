import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

interface Thread {
    id: number;
    title: string;
    // Add any other properties your Thread might have
}

const ThreadPage: React.FC = () => {
    const [threads, setThreads] = useState<Thread[]>([]);

    useEffect(() => {
        axios.get<Thread[]>('/api/threads')
            .then((response) => {
                // Explicitly cast the response data to Thread[]
                setThreads(response.data as Thread[]);
            });
    }, []);

    return (
        <div>
            {/* Your ThreadPage rendering logic here */}
            {threads.map((thread) => (
                <div key={thread.id}>
                    {thread.title}
                </div>
            ))}
        </div>
    );
};

export default ThreadPage;
