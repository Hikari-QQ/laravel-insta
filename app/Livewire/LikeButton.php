<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    // ここにあった $fillable は削除しました
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return;
        }

        if ($this->post->isLiked()) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
        } else {
            $this->post->likes()->create([
                'user_id' => Auth::id()
            ]);
        }

        $this->post->load('likes');
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}