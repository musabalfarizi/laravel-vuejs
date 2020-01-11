<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Events\PostPublished;
use Illuminate\Support\Facades\Validator;

class PostingController extends Controller
{
   

    public function store(Request $request) {

    	$data = $request->only(['title','description']);

    	$post = Post::create($data);
    	event(new PostPublished($post));

    	return response($post, 201);

    }
  
}
