
@extends('layouts.app')
@section('title')
  {{$post->title}}
@endsection
@section('content')
<div>
    @if (session()->has('message'))
        <div class="alerte-succes"> {{session()->get('message')}}</div>
    @endif

</div>
    <div class="p-5 container text-center">
        <h1 class="fw-bold fs-1 ">{{$post->title}}</h1>
        <h6 class=" text-secondary">Posted By <span class="text-dark">{{$post->user->name}}</span> on <span class="fw-light text-dark">{{$post->updated_at}}</span></h6>
        <img src="/images/{{$post->image_path}}" class="img-fluid w-100">
        <p>{{$post->description}}</p>
        <br><br>
        <div>
            @if (Auth::user() && $post->user_id == Auth::user()->id)
                <a href="/blog/{{$post->slug}}/edit" class="btn btn-secondary py-2 px-3">Edit Post</a>
                <br>
                <div>
                    <form action="/blog/{{$post->slug}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-secondary py-2 px-3 m-4" type="submit">Delete Post</button>

                    </form>
                </div>
            @endif

        </div>
     </div>
@endsection

