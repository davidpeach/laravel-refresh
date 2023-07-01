<!doctype html>

<meta charset=utf-8 />
<title>David Peach's Homepage</title>
<link rel=stylesheet href=/style.css />
@guest
    <a href="/register">Register</a>
    <a href="/login">Login</a>
@else
    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endguest
<body>
{{ $slot }}
</body>
