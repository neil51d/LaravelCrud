<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Return a form or something if needed
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post, 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        // Return an edit form or something if needed
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($post);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}