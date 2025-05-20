<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $messages = \Auth::user()->messages()->orderBy('created_at', 'desc')->paginate();
        return view('home.index', ['messages' => $messages]);
    }
    
}
