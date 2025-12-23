<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public $timestamps = false;
    protected $primaryKey = ['follower_id', 'following_id'];
    public $incrementing = false;

    #TO get the info of a follower
    public function follower() {
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }

    #TO get the info of a following
    public function following() {
        return $this->belongsTo(User::class, 'following_id')->withTrashed();
    }
}
