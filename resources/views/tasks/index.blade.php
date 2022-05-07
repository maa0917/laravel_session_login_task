<x-layout>
    <h1>タスク一覧ページ</h1>

    <table>
        <thead>
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th colspan="3"></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->content }}</td>
                <td><a href="{{ route('tasks.show', $task) }}">詳細</a></td>
                <td><a href="{{ route('tasks.edit', $task) }}">編集</a></td>
                <td>
                    <form action="{{ route('tasks.destroy', $task) }}" method="post">
                        @csrf
                        @method('delete')
                        <input id="delete-button" type="submit" value="削除"
                               onclick='return confirm("本当に削除してもよろしいですか？");'>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('tasks.create') }}">新規登録</a>

</x-layout>
