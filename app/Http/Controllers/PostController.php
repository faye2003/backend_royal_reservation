<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(private PostService $postService) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $item = $this->postService->getPosts($request);
            return response()->json(new PostCollection($item), 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue lors de la récupération des posts',
                'error' =>  config('app.debug') ? $e->getMessage() : null
            ], 500);
        }

    }

    public function show($id): JsonResponse
    {
        try {
            $post = $this->postService->findById($id);
            if (!$post) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ce post non trouvé',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'post' => [new PostResource($post)],
                'accounts' => [new AccountCollection($post->accounts)]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération de Ce post',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }


    public function store(StorePostRequest $request)
    {
         try {
            $item = $this->postService->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Post créé avec succès',
                'post' => new PostResource($item)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la création du post',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $post = $this->postService->findById($id);
            if (!$post) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ce post non trouvé',
                ], 404);
            }
            $updatedPost = $this->postService->update($post, $request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Ce post mis à jour avec succès',
                'user' => new PostResource($updatedPost)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour de Ce post',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function delete ($id)
    {
        try {
            $post = $this->postService->findById($id);
            if (!$post) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ce post non trouvé',
                ], 404);
            }
            $this->postService->delete($post);
            return response()->json([
                'status' => 'success',
                'message' => 'Ce post supprimé avec succès',
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue lors de la suppression de Ce post',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
