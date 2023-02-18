<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\post;
use Illuminate\Support\Str;



class PostsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return(view('blogs.index'))->with('posts',post::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     // 'image'=>'required | mimes:jpg,png,jpeg | max:5048',
        // ]);
        $slug = Str::slug($request->title);
        $newimageName=uniqid().'-'.$slug . '.' . $request->image->extension();
        $request->image->move(public_path('images'),$newimageName);

        post::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'slug'=>$slug,
            'image_path'=>$newimageName,
            'user_id'=>auth()->user()->id

        ]);
        return redirect('/blog')->with('created','');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('blogs.show')->with('post',post::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        return view('blogs.edit')->with('post',post::where('slug',$slug)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug)
    {
          // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     // 'image'=>'required | mimes:jpg,png,jpeg | max:5048',
        // ]);
        $newSlug = Str::slug($request->title);
        if($request->image==null){
            post::where('slug',$slug)->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'slug'=>$newSlug,
                'user_id'=>auth()->user()->id

            ]);
        }
        else{
            $newimageName=uniqid().'-'.$newSlug . '.' . $request->image->extension();
            $request->image->move(public_path('images'),$newimageName);

            post::where('slug',$slug)->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'slug'=>$newSlug,
                'image_path'=>$newimageName,
                'user_id'=>auth()->user()->id

            ]);
        }

        return redirect('/blog/'.$newSlug)->with('message','Post modified with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        post::where('slug',$slug)->delete();
        return redirect('/blog')->with('deleted','');
    }
}
