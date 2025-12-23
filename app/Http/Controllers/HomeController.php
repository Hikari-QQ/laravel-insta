<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;
    private $user;
    private $story;

    public function __construct(Post $post, User $user,Story $story)
    {
        $this->post = $post;
        $this->user = $user; 
        $this->story = $story;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $all_posts = $this->post->latest()->get();
        // return view('users.home')->with('all_posts', $all_posts);
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();
        
        $stories = Story::where('expires_at', '>', now())
        ->with('user')
        ->orderBy('id', 'asc')
        ->get()
        ->filter(function ($story) {
            return $story->user->isFollowing(Auth::user())
                || $story->user->id === Auth::id();
        });

        $home_stories = $stories->groupBy('user_id');
        
        return view('users.home')
                ->with('home_posts', $home_posts)
                ->with('suggested_users', $suggested_users)
                ->with('home_stories',$home_stories);
    }

    #Get the posts of the users that Auth user is following
    public function getHomePosts() {
        $all_posts = $this->post->latest()->get();
        $home_posts = [];

        foreach($all_posts as $post) {
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id) {
                $home_posts[] = $post;
            }
        }
        return $home_posts;
    } 
    #Get the stories of the users that Auth user is following
    public function getStories() {
        $all_stories = $this->story->latest()->get();
        $home_stories = [];

        foreach($all_stories as $story) {
            if($story->user->isFollowed() || $story->user->id === Auth::user()->id) {
                $home_stories[] = $story;
            }
        }
        return $home_stories;
    } 

    #Get the users that the Auth user is not following
    public function getSuggestedUsers() {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user) {
            if(!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }
        return $suggested_users;
    }

    public function search(Request $request) {
        $users = $this->user->where('name', 'like', '%'.$request->search.'%')->get();

        return view('users.search')->with('users', $users)->with('search', $request->search);
    }

    public function seeAll() {
        $suggested_users = $this->getSuggestedUsers();

        return view('users.suggestedUsers-all')->with('suggested_users', $suggested_users);
    }
}
