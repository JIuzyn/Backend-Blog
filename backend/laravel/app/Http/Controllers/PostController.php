<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    public function index(): LengthAwarePaginator
    {
        return Post::query()->paginate(10);
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        $post = Post::create([
            'header' => $request->validated('header'),
            'content' => $request->validated('content'),
            'user_id' => auth()->id()
        ]);

        return response()->json($post);
    }

    public function update(Post $post, PostUpdateRequest $request): JsonResponse
    {
        $post->update([
           'header' => $request->validated('header') ?: $post->header,
           'content' => $request->validated('content') ?: $post->content,
        ]);

        return response()->json($post);
    }

    public function delete(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json();
    }
}
