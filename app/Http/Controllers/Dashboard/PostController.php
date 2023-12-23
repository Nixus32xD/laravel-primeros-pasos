<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd(Category::find(1)->post);
        // $posts = Post::get();
        $posts = Post::paginate(2);

        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        // dd($categories);

        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // $validate = FacadesValidator::make($request->all(), StoreRequest::myRules());

        // dd($validate->fails());
        // dd($validate->errors());

        // $data = $request->validated();

        // $data['slug'] = Str::slug($data['title']);
        // dd($data);

        Post::create($request->validated());

        // return route('post.create');
        // return redirect('/post/create');
        // return redirect()->route('post.create');
        return to_route('post.index')->with('status', 'Registro Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');

        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $data = $request->validated();
        if (isset($data['image'])) {

            $data['image'] = $filename = time() . '.' . $data['image']->extension();

            $request->image->move(public_path('image'), $filename);
        }

        $post->update($data);
        // $request->session()->flash('status', 'Registro Actualizado');
        return to_route('post.index')->with('status', 'Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('status', 'Registro Eliminado');
    }
}
