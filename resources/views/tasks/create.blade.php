<x-layout>
    <h1>タスク登録ページ</h1>

    <x-form task="">
        <x-slot name="action">{{ route('tasks.store') }}</x-slot>

        <x-slot name="method">post</x-slot>

        <x-slot name="submit">登録する</x-slot>
    </x-form>

    <a href="{{ route('tasks.index') }}">戻る</a>
</x-layout>
