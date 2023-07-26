<x-layout>
    <h1>Login</h1>
    <form method="POST" action="/login">
        {!! csrf_field() !!}

        <label for="username">
            <span>Username</span>
            <input type="text" name="username" id="username" value="{{ old('username') }}"/>
        </label>
        @error('username')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">
            <span>Password</span>
            <input type="password" name="password" id="password" />
        </label>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Register</button>
    </form>
</x-layout>

