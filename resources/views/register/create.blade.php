<x-layout>
    <h1>Register</h1>
    <form method="POST" action="/register">
        {!! csrf_field() !!}

        <label for="name">
            <span>Name</span>
            <input type="text" name="name" id="name" value="{{ old('name') }}"/>
        </label>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="username">
            <span>Username</span>
            <input type="text" name="username" id="username" value="{{ old('username') }}"/>
        </label>
        @error('username')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">
            <span>Username</span>
            <input type="email" name="email" id="email" value="{{ old('email') }}"/>
        </label>
        @error('email')
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
