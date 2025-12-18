<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    private $story;

    public function __construct(Story $story){
        $this->story = $story;
    }

    public function create(){
        return view('users.stories.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'story_image' => 'required||mimes:jpeg,jpg,png,gif|max:1048' 
    ]);

    $this->story->user_id = Auth::user()->id;
    $this->story->story_image = 'data:image/' . $request->story_image->extension() . ';base64,' . base64_encode(file_get_contents($request->story_image));
    $this->story->expires_at = now()->addMinutes(1);
    $this->story->save();

    return redirect()->route('index');
    }

    public function show($id){
        $story = $this->story->findOrFail($id);
        
        // nextStory
        $nextStory = Story::where('expires_at', '>', now())
        ->where('id', '>', $story->id)
        ->orderBy('id')
        ->first();


        return view('users.stories.index')
        ->with('story',$story)
        ->with('nextStory',$nextStory);
    }

    public function destroy($id){
        $story = $this->story->findOrFail($id);
        $story->delete();

        return redirect()->route('index');
    }
}
