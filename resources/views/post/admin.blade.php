@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-success text-center">{{ session('msg') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center">{{ $errors->message }}</div>
        @endif
        <table class="table">
            <thead class="table-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col" style="width: 60%">Title</th>
                <th scope="col" style="width: 20% ">Opstion</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td class="">{{Str::limit($post->title, 70)}}</td>
                        <td style="font-size: 120%">
                            <a href=" {{ route('post_update', $post->id) }} " class="link-opacity-50-hover link"><i class="fa-solid fa-pen"></i></a> | 
                            <a onclick="sure()" type="submit" href="{{route('post_delete', $post->id)}}" class="link-opacity-50-hover link-warning"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <h2>Bạn chưa có bài viết nào</h2>
                @endforelse
            </tbody>
          </table>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function sure() {
            confirm('Xoá bài viết này?');
        }
    </script>
@endsection