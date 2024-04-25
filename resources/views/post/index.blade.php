@extends('layouts.app')
@section('content')
    <div class="container">
        @isset($posts)
            <div class="list-group">
                @foreach ($posts as $post)
                    <a href="{{ url('post/' . $post->id) }}" class="list-group-item list-group-item-action flex-column align-items-start my-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h2 class="mb-1">{{$post->title}}</h2>
                            <small>
                                @php
                                    $createdUnix = strtotime($post->created_at);
                                    $nowUnix = time();
                                    $diffInSecond = $nowUnix - $createdUnix;
                                    echo floor($diffInSecond/86400) . ' days ago';
                                @endphp 
                            </small>
                        </div>
                        <span>{{ Str::limit($post->content, 50) }}</span>
                        @if (Auth::user()->is_admin)
                            <a href="{{ url('post/' . $post->id . '/edit') }}" class="">Edit Post</a>
                        @endif
                    </a>
                @endforeach
            </div>
            <div>
                {{$posts->links()}}
            </div>
        @endisset
    </div>
@endsection