<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');


        $blogs = Blog::with('user')
            ->orderBy('created_at')
            ->get();

        return Inertia::render('Dashboard', [
            'blogs' => $blogs,
            'authUserId' => Auth::id(),
            'search' => $search
        ]);
    }

    public function blog()
    {
        return Inertia::render('BlogAdd');
    }
    public function viewBlog(Blog $blog)
    {
        $blog = Blog::with('user')->findOrFail($blog->id);

        return Inertia::render('BlogShow', [
            'blog' => $blog
        ]);
    }
    public function userBlog()
    {
        $user = Auth::user();
        $blogs = $user->blogs()->orderByDesc('created_at')->get();

        return Inertia::render('UserBlog', [
            'blogs' => $blogs,
            'authUserId' => Auth::id()
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:55',
            'content' => 'required|string|min:30',
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
    public function viewUpdateBlog(Blog $blog)
    {
        $blog = Blog::with('user')->findOrFail($blog->id);
        return Inertia::render('BlogUpdate', [
            'blog' => $blog
        ]);
    }
    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:55',
            'content' => 'required|string|min:30',
            'category' => 'required',
            'image' => 'nullable|max:2048'

        ]);



        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $blog->update($validatedData);

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
        return redirect()->back();
    }
}
