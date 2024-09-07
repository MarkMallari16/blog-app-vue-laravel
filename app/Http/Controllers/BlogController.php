<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->orderByDesc('created_at')->get();

        return Inertia::render('Dashboard', [
            'blogs' => $blogs,
            'authUserId' => Auth::id()
        ]);
    }

    public function blog()
    {
        return Inertia::render('BlogAdd');
    }
    public function viewBlog(Blog $blog)
    {
        return Inertia::render('BlogShow', [
            'blog' => $blog
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required',
            'image' => 'required|file|mimes:png,jpg,jpeg',
          
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        Storage::putFileAs('public/images', $image, $imageName);

        Blog::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category' => $validatedData['category'],
            'user_id' => auth()->id(),
            'image' => "images/{$imageName}"
        ]);

        session()->flash('success', 'Blog created successfully.');

        return redirect()->route('dashboard');
    }
    public function delete(Blog $blog)
    {
        $auth = Auth::id();

        if ($blog->user_id === $auth) {
            $blog->delete();
            session()->flash('success', 'Blog deleted successfully.');
        } else {
            abort(403, 'You are not authorized to delete this blog.');
        }
        return redirect()->route('dashboard');
    }
}
