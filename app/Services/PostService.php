<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class PostService
{
    public function store(array $data): void
    {
        try {
            DB::beginTransaction();

            $tagsIds = [];

            if (isset($data['tags_ids'])) {
                $tagsIds = $data['tags_ids'];
                unset($data['tags_ids']);
            }

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

            $post = Post::firstOrCreate($data);

            $post->tags()->attach($tagsIds);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update(array $data, Post $post): Post
    {
        try {
            DB::beginTransaction();

            $tagsIds = [];

            if (isset($data['tags_ids'])) {
                $tagsIds = $data['tags_ids'];
                unset($data['tags_ids']);
            }

            if (isset($data['preview_image'])) {
                Storage::disk('public')->delete($post->preview_image);
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            if (isset($data['main_image'])) {
                Storage::disk('public')->delete($post->main_image);
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            $post->update($data);

            $post->tags()->sync($tagsIds);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return $post;
    }
}
