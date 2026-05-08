<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Normalizer\SlugNormalizer;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::all();
        return view('admin.blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image_file' => 'required|image|mimes:jpg,jpeg,png,webp,gif',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->description = $request->description;
        $post->active= $request->active ? 1:0;
        if($request->publish_at && $request->publish_at >  Carbon::today() ){
            $post->publish_at= $request->publish_at;
        }


        $post->slug = $this->createSlug($post->title);
        $filename = time() . "." . $request->file('image_file')->getClientOriginalExtension();
        try {
            $request->file('image_file')->storeAs("public/posts/$post->id", $filename);

        } catch (\Throwable $th) {
            throw $th;
        }
        $post->img_file = $filename;
        $post->save();

        return redirect()->back()->with('success', trans('correctly saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $seo=DB::table('seo_config')->find(12);

        return view('guest.blog.index',compact('posts','seo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.blog.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request['active'] = $request->active ? 1:0;

        $new_slug= $request->slug;
        if($post->slug !== $new_slug){
            $slugAlreadyExist = DB::table('posts')->where('slug', $new_slug)->exists();
            if($slugAlreadyExist){
                return redirect()->back()->with('error','Slug ya existe, selecciona otro');
            }else{
                $slugnmz = new SlugNormalizer();
                $slug= $slugnmz->normalize($new_slug);
                $request['slug']=$slug;
            }
        }

        $post->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Storage::delete("public/posts/$post->id/$post->filename");
        return back();

    }

    public static function generateTinyUrl()
    {

    }

    public function createSlug($str)
    {
        $slugnmz = new SlugNormalizer();
        $slug= $slugnmz->normalize($str);

        $slugAlreadyExist = DB::table('posts')->where('slug', $slug)->exists();
        if($slugAlreadyExist){
            do {
                $slug= $slug.rand(1,999);
                $slugAlreadyExist = DB::table('posts')->where('slug', $slug)->exists();

                } while ($slugAlreadyExist);
        }


        return $slug;
    }
}
