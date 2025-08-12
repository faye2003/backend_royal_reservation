<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostService
{

    public function getPosts(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');

        $query = Post::query();

        $query->orderBy($sort, $order);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(int $id): ?Post
    {
        return Post::find($id);
    }

    public function create(array $data)
    {
        // if (empty($data['slug']) && !empty($data['titre'])) {
        //     $data['slug'] = Str::slug($data['titre']);
        // }
        return Post::create($data);
    }

    public function update(Post $item, array $data): Post
    {

        $item = Post::findOrFail($item->id);

        $item->update($data);
        return $item->fresh();

    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
