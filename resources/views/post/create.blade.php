@extends('layouts.app')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <h3 class="card-header">{{ 'Tạo bài viết mới' }}</h3>
    
        <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger text-center">Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu</div>
        @endif
        @if (session('msg'))
            <div class="alert alert-success text-center">{{ session('msg') }}</div>
        @endif

        <form method="POST" action="{{ url('admin/post/create') }}">
            @csrf
            <div class=" mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-start">{{ 'Tiêu đề bài viết' }}</label>
                <div class="col-12">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autofocus placeholder="Tiêu đề ...">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="mb-3">
                <label for="Content" class="col-md-4 col-form-label text-md-start">{{ 'Nội dung bài viết' }}</label>
                <div class="col-12">
                    <textarea name="content" id="Content" style="width: 100%" rows="10" placeholder="Nội dung bài viết ... " class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ 'Tạo bài viết' }}
                    </button>
                </div>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
@endsection