<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return view('index', compact('posts'))->with('i', (request()->input('page', 1) - 1) *5 );
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
            'description' => 'required',
            'suma' => 'required',
            'image' => 'required|file|max:2048'
        ]);

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
        }

        Post::create([
            'description' => $request->input('description'),
            'suma' => $request->input('suma'),
            'image' => $imagePath,
        ]);

        return redirect()->route('index')->with('success', 'Post created seccessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
    public function destroy(Post $post)
    {
        //
    }
}
