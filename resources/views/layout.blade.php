<html>
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>ToDoList</title>
</head>
<body>
    <header>
        @if(Auth::user())
            <h2 style="margin-left: 10px">Hello, {{\App\Models\User::find(Auth::id())->name }}</h2>
            <a href="logout" class="menubtn">Logout</a>
            <a href="main" class="menubtn">My lists</a>
        @else
            <a href="login" class="menubtn">Login</a>
            <a href="register" class="menubtn">Register</a>
        @endif

    </header>
    @yield('content')
</body>
</html>
