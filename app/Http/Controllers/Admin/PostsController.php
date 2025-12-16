<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index() {
        $all_posts = $this->post->withTrashed()->latest()->get();

        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    public function hidden($id) {
        $this->post->destroy($id);
        
        return redirect()->back();
    }

    public function visible($id) {
        $this->post->onlyTrashed()->findOrFail($id)->restore();
        //onlyTrashed - retrieves soft deleted records only
        //restore() - un-delete a soft deleted. Will set "deleted_at" column to null.
        return redirect()->back();
    }
}
