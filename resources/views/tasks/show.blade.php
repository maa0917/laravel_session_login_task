<x-layout>
    <h1>タスク詳細ページ</h1>

    <p>
        <strong>タイトル:</strong>
        {{ $task->title }}
    </p>

    <p>
        <strong>内容:</strong>
        {{ $task->content }}
    </p>

    <a href="{{ route('tasks.edit', $task) }}">編集</a> |
    <a href="{{ route('tasks.index') }}">戻る</a>
</x-layout>
