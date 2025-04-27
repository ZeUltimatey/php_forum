<?php

namespace Database\Seeders;

use App\Models\Thread;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thread::create([
            'title' => 'Welcome to the Forum',
            'content' => 'This is the first thread in our forum. Feel free to introduce yourself!',
            'user_id' => 1,
        ]);

        Thread::create([
            'title' => 'Forum Rules and Guidelines',
            'content' => 'Please read these rules before posting any content on this forum...',
            'user_id' => 1,
        ]);

        Thread::create([
            'title' => 'How to use Markdown in posts',
            'content' => 'You can use Markdown to format your posts. Here are some examples...',
            'user_id' => 1,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            Thread::create([
                'title' => "Sample Discussion Topic $i",
                'content' => "This is the content for sample discussion topic $i. Feel free to contribute!",
                'user_id' => 1,
            ]);
        }
    }
}
