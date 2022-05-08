<x-layout>
    <h1>ログインページ</h1>

    <form method="POST" action="{{ route('sessions.store') }}">
        @csrf

        @if ($errors->isNotEmpty())
            <div id="error_explanation">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>
            <label for=email">メールアドレス</label>
            <br>
            <input id="email" type="text" name="email" value="{{ old('email') }}">
        </p>

        <p>
            <label for="password">パスワード</label>
            <br>
            <input id="password" type="password" name="password">
        </p>

        <input id="create-session" type="submit" value="ログイン">
    </form>
</x-layout>