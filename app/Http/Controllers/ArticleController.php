<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $userCount = User::where('role', 'user')->count();
        $adminCount = User::where('role', 'admin')->count();
        $publishedArticles = Article::where('status', 'published')->count();
        $unpublishedArticles = Article::where('status', 'draft')->count();

        // Hitung jumlah PickupRequest berdasarkan jenis sampah
        $jumlahSampahTPS = PickupRequest::where('jenis_sampah', 'TPS')->count();
        $jumlahSampahTPA = PickupRequest::where('jenis_sampah', 'TPA')->count();

        return view('dashboard.articles', compact(
            'articles',
            'userCount',
            'adminCount',
            'publishedArticles',
            'unpublishedArticles',
            'jumlahSampahTPS',
            'jumlahSampahTPA'
        ));
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'status' => 'required|in:published,draft',
                'image' => 'required|mimes:jpg,jpeg,png|max:10000',
            ]);

            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;

            Article::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'image' => $validatedData['image'],
                'status' => $validatedData['status'],
                'user_id' => Auth::id(),
                'published_at' => $validatedData['status'] === 'published' ? now() : null,
                'slug' => str()->slug($validatedData['title']),
            ]);

            return redirect()->route('admin.home')->with('success', 'Article created successfully.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Failed to create article.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'editTitle' => 'required|string|max:255',
                'editContent' => 'required|string',
                'editStatus' => 'required|in:published,draft',
                'image' => 'nullable|mimes:jpg,jpeg,png|max:10000',
            ]);

            $article = Article::findOrFail($id);

            $article->update([
                'title' => $validatedData['editTitle'],
                'content' => $validatedData['editContent'],
                'slug' => str()->slug($validatedData['editTitle']),
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $article->update(['image' => $imagePath]);
            }

            if ($validatedData['editStatus'] !== $article->status) {
                $article->update([
                    'status' => $validatedData['editStatus'],
                    'published_at' => $validatedData['editStatus'] === 'published' ? now() : null,
                ]);
            }

            return redirect()->route('admin.home')->with('success', 'Article updated successfully.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Failed to update article.');
        }
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('dashboard.article-detail', compact('article'));
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();

            return redirect()->route('admin.home')->with('success', 'Article deleted successfully.');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'Failed to delete article.');
        }
    }

    public function listArticles()
    {
        $articles = Article::where('status', 'published')->get();
        return view('artikel.listArtikel', compact('articles'));
    }

    public function showArticle($id)
    {
        try {
            $article = Article::where('status', 'published')->findOrFail($id);
            return view('artikel.article-detail', compact('article'));
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Article not found.');
        }
    }
}