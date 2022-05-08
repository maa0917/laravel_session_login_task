<x-layout>
    <h1>タスク登録ページ</h1>

    <x-tasks.form task="">
        <x-slot name="action">{{ route('tasks.store') }}</x-slot>

        <x-slot name="method">post</x-slot>

        <x-slot name="submit">登録する</x-slot>
    </x-tasks.form>

    <a href="{{ route('tasks.index') }}">戻る</a>
</x-layout>
