<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel session login task</title>
</head>
<body>
@if (auth()->check())
    <ul>
        <li>
            <form action="{{ route('sessions.destroy', auth()->user()) }}" method="post" name="session_delete">
                @csrf
                @method('delete')

                <a id="sign-out" href="javascript:session_delete.submit()">ログアウト</a>
            </form>
        </li>
    </ul>
@else
    <ul>
        <li><a id="sign-up" href="{{ route('users.create') }}">アカウント登録</a></li>
    </ul>
@endif

{{session('notice')}}

{{ $slot }}
</body>
</html>
