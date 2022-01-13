<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DefaultController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        return Response::view('default.home',[
            'posts' => $posts
        ]);
    }
}
