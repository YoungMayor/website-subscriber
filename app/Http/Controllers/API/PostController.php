<?php

namespace App\Http\Controllers\API;

use App\Actions\Post\CreatePost;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return apiResponse(StatusCode::OK, 'Coming Soon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, CreatePost $createPost)
    {
        $post = $createPost->fromRequest($request);

        return apiResponse(
            StatusCode::CREATED,
            'app.post.created',
            (new PostResource($post))->resolve()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return apiResponse(StatusCode::OK, 'Coming Soon');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        return apiResponse(StatusCode::OK, 'Coming Soon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return apiResponse(StatusCode::OK, 'Coming Soon');
    }
}
