<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function view()
    {
        return Inertia::render('PostAdd');
    }
    public function show(Post $post)
    {
        return Inertia::render('PostShow', [
            'post' => $post
        ]);
    }
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('created_at')->get();

        return Inertia::render('Dashboard', [
            'posts' => $posts,
            'authUserId' => Auth::id()
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|file|mimes:png,jpg,jpeg',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        Storage::putFileAs('public/images', $image, $imageName);

        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
            'image' => "images/{$imageName}"

        ]);

        session()->flash('success', 'Post created successfully.');

        return redirect()->route('dashboard');
    }
    public function delete(Post $post)
    {
        $auth = Auth::id();

        if ($post->user_id === $auth) {
            $post->delete();
            session()->flash('success', 'Post deleted successfully.');
        } else {
            session()->flash('error', 'You are not authorized to delete this post.');
        }
        return redirect()->route('dashboard');
    }
}
