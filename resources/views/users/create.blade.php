<x-layout>
    <h1>アカウント登録ページ</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        @if ($errors->isNotEmpty())
            <div id="error_explanation">
                <h2>{{ $errors->count() }} prohibited this task from being saved:</h2>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>
            <label for="Name">名前</label>
            <br>
            <input id="name" type="text" name="name" value="{{ old('name') }}">
        </p>

        <p>
            <label for=Email">メールアドレス</label>
            <br>
            <input id="email" type="text" name="email" value="{{ old('email') }}">
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

        <input type="submit" value="登録する">
    </form>
</x-layout>
