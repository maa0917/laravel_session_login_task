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
                    <form action="{{ route('tasks.destroy', $task) }}" method="post" name="task_delete">
                        @csrf
                        @method('delete')

                        <a href="javascript:task_delete.submit()" onclick='return confirm("本当に削除してもよろしいですか？")'>削除</a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('tasks.create') }}">新規登録</a>

</x-layout>
