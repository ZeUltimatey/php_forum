<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    /**
     * Display a listing of the threads.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $threads = Thread::latest()->get();
        return response()->json($threads);
    }

    /**
     * Store a newly created thread in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $thread = Thread::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return response()->json($thread, 201);
    }

    /**
     * Display the specified thread.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $thread = Thread::with('replies')->findOrFail($id);
        return response()->json($thread);
    }

    /**
     * Update the specified thread in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $thread = Thread::findOrFail($id);

        // Authorization check (optional)
        // if (auth()->id() !== $thread->user_id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $thread->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($thread);
    }

    /**
     * Remove the specified thread from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $thread = Thread::findOrFail($id);

        // Authorization check (optional)
        // if (auth()->id() !== $thread->user_id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $thread->delete();
        return response()->json(null, 204);
    }
}
