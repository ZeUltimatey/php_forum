<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Thread $thread)
    {
        return $thread->posts()->with('user', 'likes')->get();
    }

    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $post = $thread->posts()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return response()->json($post, 201);
    }

    public function show(Thread $thread, Post $post)
    {
        return $post->load('user', 'likes');
    }

    public function update(Request $request, Thread $thread, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    public function destroy(Thread $thread, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->noContent();
    }
}
