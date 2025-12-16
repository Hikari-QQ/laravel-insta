<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $category;
    private $categoryPost;
    private $post;

    public function __construct(Category $category, CategoryPost $categoryPost, Post $post) {
        $this->category = $category;
        $this->categoryPost = $categoryPost;
        $this->post = $post;
    }

    public function index() {
        $all_categories = $this->category->all();
        $all_posts = $this->post->all();

        $uncategorized = 0;
        
        foreach ($all_posts as $post) {
            if($this->categoryPost->where('post_id', $post->id)->get()->isEmpty()) {
                // other way
                // 1. if($this->categoryPost->where('post_id', $post->id)->count() == 0)
                // 2. $uncstegorized = $this->post->whereDoesntHave('categoryPost')->count();
                
                $uncategorized++;
            }
        }

        return view('admin.categories.index')
            ->with('all_categories', $all_categories)
            ->with('uncategorized', $uncategorized);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->route('admin.categories');
    }

    public function destroy($id) {
        $category = $this->category->findOrFail($id);
        $category_post = $this->categoryPost->where('category_id', $id);
        
        $category->delete();
        $category_post->delete();

        return redirect()->route('admin.categories');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $category = $this->category->findOrFail($id);

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories');
    }
}
