<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;

class CollectionController extends Controller
{
    public function index(User $user)
    {
        $user->load('media');

        return new UserResource($user);
    }

    public function store(User $user, Media $media)
    {
        if ($user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi pengguna.'
            ], 409);
        }

        $user->media()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi.',
            'data' => new MediaResource($media)
        ], 201);
    }

    public function destroy(User $user, Media $media)
    {
        if (!$user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media tidak ditemukan dalam koleksi pengguna.'
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi.'
        ], 200);
    }
}
