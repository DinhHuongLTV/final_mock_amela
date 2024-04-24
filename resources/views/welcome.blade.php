<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <title>@yield('page_title')</title>
</head>
<body>
    <div class="container">
        <div class="row">
            @error('email')
                <div style="background: red">{{ $message }}</div>
            @enderror
            @error('password')
                <div style="background: red">{{ $message }}</div>
            @enderror
            <div class="col-6 d-flex justify-content-end">
                <form action="{{url('login')}}" method="POST">
                    @csrf
                    <div class="">
                        <label for="">Email: </label>
                        <input type="text" name="email" id="" class="form-control">
                    </div>
                    <div class="my-3">
                        <label for="">Password: </label>
                        <input type="password" name="password" id="" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-small">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>