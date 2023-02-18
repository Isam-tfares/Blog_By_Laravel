@extends('layouts.app')
@section('title')
    Blogs
@endsection
@section('content')
    <div class="bg-white">
        <div class="container p-3">
            @if (session()->has('created'))
                <div class="alert alert-success text-center" role="alert">
                    Post Created with success
                </div>
            @endif
            @if (session()->has('deleted'))
                <div class="alert alert-secondary text-center" role="alert">
                    Post deleted with sucess
                </div>
            @endif

        </div>
        <div class="p-2 container">
            <h1 class=" text-center">ALL POSTS</h1>
        </div>
        <div class="container p-3 text-center">
            @if (Auth::check())
                <a href="/blog/create" class="btn btn-secondary py-2 px-3">Create post</a>
            @endif
        </div>
        <div class="container d-flex justify-content-center align-items-center flex-column">
            @foreach ($posts as $item)
                <div class="p-3 d-flex flex-md-row flex-column justify-content-center">
                    <div style="width:50%" class="w-lg-25 w-sm-50 w-75"> <img class="img-fluid w-100"
                            src="/images/{{ $item->image_path }}" height=""></div>
                    <div style="width:50%" class="w-lg-50 w-sm-50 w-75 p-2">
                        <h2 class=" fw-bold fs-1 px-2">{{ $item->title }}</h2>
                        <h6 class="text-secondary fw-light ps-2">Posted By <span
                                class="text-dark">{{ $item->user->name }}</span> on <span
                                class="fw-light text-dark">{{ date('d-m-y', strtotime($item->updated_at)) }}</span></h6>
                        <p class="fw-light p-2">{{ $item->description }} </p>
                        <a class="btn btn-secondary d-block  mt-4" style="width:120px" href='/blog/{{ $item->slug }}'>See
                            it</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
