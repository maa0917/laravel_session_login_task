<x-layout>
    <h1>アカウント詳細ページ</h1>

    <p><strong>名前: </strong>{{ $user->name }}</p>

    <p><strong>メールアドレス: </strong>{{ $user->email }}</p>

    <a id="edit-user" href="{{ route('users.edit', $user) }}">編集</a> |
    <form action="{{ route('users.destroy', $user) }}" method="post" name="user_delete" style="display: inline">
        @csrf
        @method('delete')

        <a id="destroy-user" href="javascript:user_delete.submit()" onclick='return confirm("本当に削除してもよろしいですか？")'>削除</a>
    </form>
</x-layout>
