<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts::all();
//        return view('posts.index')->with('posts',$posts);
//        $posts = DB::select('select * from posts order by id desc');
        //$posts = post::orderBy('title','asc')->get();
        //$posts = post::orderBy('title','asc')->take(1)->get();

        $posts = post::orderBy('id','desc')->SimplePaginate(3);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('cover_image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->File('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->File('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else
            {
                $fileNameToStore = 'noimage.jpeg';
            }

        //create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);

        //check for correct user

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);

        //handle file upload
        if($request->hasFile('cover_image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->File('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->File('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check for correct user

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        if($post->cover_image !== 'noimage.jpeg') {
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');
    }
}
