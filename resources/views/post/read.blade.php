@extends('layouts.app')
@section('content')
    <div class="container">
        @if (isset($post))
            <h1>{{$post->title}}</h1>
            <p>{{$post->content}}</p>
        @else
            <h2>Post không tồn tại</h2>
        @endif
    </div>
@endsection