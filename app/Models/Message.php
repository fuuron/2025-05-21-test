<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Step7オプション課題：MessageとLikeの一対多のリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Step8オプション課題：Userとの多対多のリレーション
    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
