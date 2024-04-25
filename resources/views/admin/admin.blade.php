@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if (Auth::check())
        <h2>Chào mừng, {{Auth::user()->name}}</h2> 
        @php
            // $user = Auth::user();
            // dd($user);
        @endphp       
    @else   
        <h2>Người dùng chưa đăng nhập</h2>
    @endif
</div>
@endsection