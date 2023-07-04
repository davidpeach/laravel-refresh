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

<footer>
    <form method="POST" action="newsletter">
        @csrf
        <label for="email">
            <span>Email</span>
            <input type="email" name="email" />
        </label>
        <button type="submit">Subscribe</button>
        @error('email')
        <aside>
            <p>{{ $message }}</p>
        </aside>
        @enderror
    </form>
</footer>
</body>
