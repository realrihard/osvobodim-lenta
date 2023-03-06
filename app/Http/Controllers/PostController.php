<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('admin.dashboard', compact('posts'))->with('i', (request()->input('page', 1) - 1) *5 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable',
            'suma' => 'nullable|regex:/^[0-9]+$/',
            'image' => 'required|file|max:2048'
        ]);

        Log::info('Validation passed');

        $imagePath = null;

        if ($request->file('image')->getClientMimeType() == 'application/pdf') {
            $pdf = new \Spatie\PdfToImage\Pdf($request->file('image'));
            $image = $pdf->saveImage(public_path('images'));
            $imagePath = 'images/' . $image;
        } else {
            $image = $request->file('image');
            $destintionPath = 'images/';
            $imagePath = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destintionPath, $imagePath);

            $thumbPath = 'thumb/' . $imagePath;
            Image::make(public_path($destintionPath . $imagePath))
                ->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($thumbPath));
        }

        $post = Post::create([
            'description' => optional($request->input('description'))->isEmpty() ? null : $request->input('description'),
            'suma' => optional($request->input('suma'))->isEmpty() ? null : $request->input('description'),
            'image' => $imagePath,
        ]);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = PostResource::collection(Post::orderBy('created_at', 'desc')->get());

        return $posts;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable',
            'suma' => 'nullable|regex:/^[0-9]+?$/',
            'image' => 'nullable|file|max:2048'
        ]);

        Log::info('Validation passed');

        $post = Post::find($id);

        if (!$post) {
            abort(404, 'Post not found');
        }

        if ($request->has('description')) {
            $post->description = $request->description;
        }

        if ($request->has('suma')) {
            $post->suma = $request->suma;
        }

        if ($request->hasFile('image')) {
            // удаляем старую картинку
            if (file_exists(base_path('public/images/'.$post->image))) {
                unlink(base_path('public/images/'.$post->image));
            }

            $imagePath = null;

            $image = $request->file('image');
            $destintionPath = 'images/';
            $imagePath = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destintionPath, $imagePath);

            $post->image = $imagePath;
        }

        $post->save();

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post) {
            $post->delete();
        }
    }
}
