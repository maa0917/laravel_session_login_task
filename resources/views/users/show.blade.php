<x-layout>
    <h1>アカウント詳細ページ</h1>

    <p><strong>名前: </strong>{{ $user->name }}</p>

    <p><strong>メールアドレス: </strong>{{ $user->email }}</p>

    <a id="edit-user" href="">編集</a> |
    <a id="destroy-user" href="">削除</a>
</x-layout>
