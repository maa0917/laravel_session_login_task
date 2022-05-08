<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)

    @if ($errors->isNotEmpty())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <p>
        <label for="Name">名前</label>
        <br>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name ?? '') }}">
    </p>

    <p>
        <label for=Email">メールアドレス</label>
        <br>
        <input id="email" type="text" name="email" value="{{ old('email', $user->email ?? '') }}">
    </p>

    <p>
        <label for="Password">パスワード</label>
        <br>
        <input id="password" type="password" name="password">
    </p>

    <p>
        <label for="password_confirmation">パスワード（確認）</label>
        <br>
        <input id="password_confirmation" type="password" name="password_confirmation">
    </p>

    <input type="submit" value="{{ $submit }}">
</form>
