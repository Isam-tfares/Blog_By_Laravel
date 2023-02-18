@extends('layouts.app')
@section('content')

<div class="imgBg d-flex justify-content-center align-items-center flex-column w-100">
    <h1 class="fw-bold text-white  mb-3"> Welcome to my Blog</h1>
    <a href="{{url('/blog')}}" class="btn btn-dark fw-bold px-3 py-2 fs-5">Start Reading</a>
</div>
@endsection
