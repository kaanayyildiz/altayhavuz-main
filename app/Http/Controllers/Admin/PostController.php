<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('id')->paginate(12);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content_tr' => 'nullable|string',
            'content_en' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'slug' => $validated['slug'] ?? str()->slug($validated['title_tr']),
            'content_tr' => $validated['content_tr'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Yazı oluşturuldu.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'content_tr' => 'nullable|string',
            'content_en' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'slug' => $validated['slug'] ?? $post->slug,
            'content_tr' => $validated['content_tr'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Yazı güncellendi.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Yazı silindi.');
    }
}


