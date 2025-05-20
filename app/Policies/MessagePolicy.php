<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    use HandlesAuthorization;

    
    public function update(User $user, Message $message)
    {
        // Step2：編集は投稿者本人のみ許可
        return $user->id == $message->user_id;
    }
    
    public function delete(User $user, Message $message)
    {
        // Step2：削除は投稿者本人のみ許可
        return $user->id == $message->user_id;
    }
}
