@extends('layouts.app')
@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
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
                                    $diffInSeconds = $nowUnix - $createdUnix;
                                    $days = floor($diffInSeconds/86400);
                                    $hours = $hours = floor(($diffInSeconds % 86400) / 3600);
                                    $minutes = floor(($diffInSeconds % 3600) / 60);
                                    $display = '';
                                    if ($days) {
                                        $display = $days . ' days ago';
                                    } else {
                                        if ($hours) {
                                            $display = $hours . ' hours ago';
                                        } else {
                                            if (!($minutes)) {
                                                $display = 'Just now';
                                            } else {
                                                $display .= $minutes . ' minutes ago';
                                            }
                                        }
                                    }
                                    
                                    echo $display;
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