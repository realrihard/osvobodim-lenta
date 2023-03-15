<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\AdminPostsResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminPostsController extends Controller
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
    public function create(Request $request)
    {
        $request->validate([
            'suma' => 'nullable|regex:/^[0-9]+$/',
            'image' => 'required|file|max:2048'
        ]);

        $imagePath = $this->uploadImage($request->image);

        $lastShowId = Post::max('showId');
        if (isset($lastShowId)) {
            $lastShowId++;
        } else {
            $lastShowId = 0;
        }

        $post = Post::create([
            'description' => optional($request->input('description'))->isEmpty() ? null : $request->input('description'),
            'suma' => optional($request->input('suma'))->isEmpty() ? null : $request->input('suma'),
            'image' => $imagePath,
            'showId' => $lastShowId
        ]);

        return response()->json([
            'message' => 'Пост был добавлен',
            'post' => $post],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $perPage = 9;
        $page = $request->query('page', 1);

        $posts = AdminPostsResource::collection(Post::orderBy('showId', 'desc')->paginate($perPage, ['*'], 'page', $page));

        return response()->json([
            'posts' => $posts,
            'pagination' => [
                'totalPages' => $posts->lastPage(),
                'currentPage' => $page,
            ],
        ]);
    }

    public function findPost($id) {
        $post = Post::find($id);

        return response()->json([
            'data' => $post
        ]);
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
            $this->deleteImages($post->image);
            $post->image = $this->uploadImage($request->image);
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

        $this->deleteImages($post->image);

        if($post) {
            $post->delete();
        }
    }

    public function uploadImage($img) {
        $filename = null;

        $image = $img;
        $destintionPath = 'images/';
        $filename = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $path = public_path('/images/' . $filename);

        // Upload original image
        Image::make($image)->save($path);

        // Get sizes of image
        $dimensions = getimagesize($path);
        $width = $dimensions[0];
        $height = $dimensions[1];

        if ($width > 1000 || $height > 1000) {
            $ratio = $width / $height;
            if ($width > $height) {
                $newWidth = 1000;
                $newHeight = intval($newWidth / $ratio);
            } else {
                $newHeight = 1000;
                $newWidth = intval($newHeight * $ratio);
            }

            // Make new compact image
            Image::make($image)
                ->resize($newWidth, $newHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path);
        }

        // make thumbs
        Image::make(public_path($destintionPath . $filename))
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('images/thumb/' . $filename));

        return $filename;
    }

    public function deleteImages($imageName) {
        // delete prev picture
        if (file_exists(base_path('public/images/'.$imageName))) {
            unlink(base_path('public/images/'.$imageName));
            unlink(base_path('public/images/thumb/'.$imageName));
        }
    }

    public function updatePostOrder(Request $request)
    {
        $parameters = $request->request;
        $newPostOrder = $parameters->all();

        foreach ($newPostOrder as $item) {
            Post::where('id', $item['id'])->update(['showId' => $item['showId']]);
        }

        return response()->json(['success' => true]);
    }
}
