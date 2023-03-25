<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostsResource;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perPage = 5;
        $page = $request->query('page', 1);

        if ($request->ajax() || $request->header('X-Requested-With') == 'XMLHttpRequest') {
            $posts = PostsResource::collection(Post::orderBy('showId', 'desc')->paginate($perPage, ['*'], 'page', $page));
            return response()->json([
                'posts' => $posts,
                'pagination' => [
                    'totalPages' => $posts->lastPage(),
                    'currentPage' => $page,
                ],
            ]);
        } else {
            if (Auth::check()) {
                $posts = PostsResource::collection(Post::orderBy('showId', 'desc')->paginate($perPage, ['*'], 'page', $page));
                return response()->json([
                    'posts' => $posts,
                    'pagination' => [
                        'totalPages' => $posts->lastPage(),
                        'currentPage' => $page,
                    ],
                ]);
            } else {
                return view('auth.login');
            }
        }
    }

}
