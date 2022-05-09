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
            <label id="email-label" for=email">メールアドレス</label>
            <br>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
        </p>

        <p>
            <label id="password-label" for="password">パスワード</label>
            <br>
            <input id="password" type="password" name="password">
        </p>

        <button id="create-session">ログイン</button>
    </form>
</x-layout>
