<x-layout>
    <h1>タスク編集ページ</h1>

    <x-tasks.form :task="$task">
        <x-slot name="action">{{ route('tasks.update', $task) }}</x-slot>

        <x-slot name="method">put</x-slot>

        <x-slot name="submit">更新する</x-slot>
    </x-tasks.form>

    <a href="{{ route('tasks.index') }}">戻る</a>
</x-layout>
