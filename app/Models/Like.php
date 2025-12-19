<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // 1. 保存を許可するカラムの設定
    protected $fillable = ['user_id', 'post_id'];

    // 2. テーブルに created_at / updated_at がない場合はこれを false にする
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}