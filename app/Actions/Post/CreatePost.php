<?php

namespace App\Actions\Post;

use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;

class CreatePost
{
    public function __invoke(
        User $author,
        Website $website,
        string $title,
        string $description,
        string $content,
        ?array $keywords = []
    ): Post {
        $post = $author->posts()->create([
            'website_ulid' => $website->ulid,
            'title' => $title,
            'description' => $description,
            'slug' => $this->makeSlug($title),
            'content' => $content,
            'keywords' => $keywords
        ]);

        return $post;
    }

    private function makeSlug(string $title): string
    {
        return str($title)->slug()->limit(48)->append(uniqid('-'))->toString();
    }

    public static function fromRequest(StorePostRequest $request): Post
    {
        return (new self)(
            $request->user(),
            $request->website,
            $request->title,
            $request->description,
            $request->content,
            $request->keywords
        );
    }
}
