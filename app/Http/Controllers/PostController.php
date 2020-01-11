<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Events\PostPublished;
use Illuminate\Support\Facades\Validator;




class PostController extends Controller
{


public function halaman(){


    	return view('halaman');
    }
    public function index()
    {
        return Post::all();
    }
     
     public function kamu(){

    	return view('selamat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request) {

    	$data = $request->only(['title','description']);

    	$post = Post::create($data);
    	event(new PostPublished($post));

    	return response($post, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          return Post::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Post::findOrFail($id);
        $posts->update($request->all());
        event(new PostPublished($posts));

        return response($posts, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();
        
        return $posts;
    }


    public function paginate()
    {
        $posts = Post::orderBy('title', 'ASC')
            ->paginate(request('limit', 5));
        if (request()->all()) {
            $posts->appends(request()->all());
        }
        return response()->json($posts);
    }
    

	/*
    public function halaman(){


    	return view('halaman');
    }
   

    public function index()
    {
        return Post::all();
    }

    public function store(Request $request) {

    	$data = $request->only(['title','description','score']);

    	$post = Post::create($data);
    	event(new PostPublished($post));

    	return response($post, 201);

    }
     public function kamu(){

    	return view('selamat');
    }

*/
}
