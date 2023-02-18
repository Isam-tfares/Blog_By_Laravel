@extends('layouts.app')
@section('title')
    Edit Blog
@endsection
@section('content')
    <div class="p-5  bg-white p-4 ">
        <div class="container">
            <h1 class="text-center mb-5">Edit Your Post</h1>

            <form action="/blog/{{ $post->slug }}" method="post" class="w-75 mx-auto" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-outline mb-4">
                    <input class="form-control" type="text" id="title" name="title" value='{{ $post->title }}'>
                    <label class="form-label" for="title">Title of post</label>
                </div>
                <div class="form-outline mb-4">
                    <textarea class="form-control" type="text" id="desc" name="description">{{ $post->description }}</textarea>
                    <label class="form-label" for="desc">A Description to the post</label>
                </div>
                <div class="form-outline mb-4">
                    <input class="form-control" type="file" name="image" id="image">
                    <label class="form-label" for="image">Add Picture</label>
                </div>


                <button type="submit" class="btn btn-primary btn-block mb-4">Edit</button>
            </form>
        </div>
    </div>
@endsection
