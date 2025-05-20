<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Step6：イイネ登録処理
    public function store(Request $request)
    {
        \Auth::user()->likeMessages()->attach($request->message_id);
        return back();
    }

    // Step6：イイネ解除処理
    public function destroy(Request $request)
    {
        \Auth::user()->likeMessages()->detach($request->message_id);
        return back();
    }   
}