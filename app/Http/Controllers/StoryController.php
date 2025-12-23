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
        'story_image' => 'required|mimes:jpg,jpeg,png,mp4,mov|max:20000'
    ]);

    $this->story->user_id = Auth::user()->id;
    $this->story->story_image = 'data:image/' . $request->story_image->extension() . ';base64,' . base64_encode(file_get_contents($request->story_image));
    $this->story->expires_at = now()->addMinutes(30);
    $this->story->save();

    return redirect()->route('index');
    }

   public function show($id)
{
    $story = Story::findOrFail($id);

    $nextStory = Story::where('user_id', $story->user_id)
        ->where('id', '>', $story->id)
        ->where('expires_at', '>', now())
        ->orderBy('id', 'asc')
        ->first();

    if (!$nextStory) {
        $nextStory = Story::where('user_id', '!=', $story->user_id)
            ->where('id', '>', $story->id)
            ->where('expires_at', '>', now())
            ->orderBy('id', 'asc')
            ->first();
    }

    return view('users.stories.index')
        ->with('story', $story)
        ->with('nextStory', $nextStory);
}

    public function destroy($id){
        $story = $this->story->findOrFail($id);
        $story->delete();

        return redirect()->route('index');
    }
}
