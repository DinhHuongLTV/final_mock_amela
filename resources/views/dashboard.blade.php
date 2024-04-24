<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<div class="container">
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <h3 class="p-5">Hello, {{$user->name}}</h3>
    <a href="{{ route('logout') }}">Logout</a>
</div>
