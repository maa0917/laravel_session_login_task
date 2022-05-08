<x-layout>
    <h1>アカウント編集ページ</h1>

    <x-users.form :user="$user">
        <x-slot name="action">{{ route('users.update', $user) }}</x-slot>

        <x-slot name="method">put</x-slot>

        <x-slot name="submit">更新する</x-slot>
    </x-users.form>

    <a id="back" href="{{ route('users.show', $user) }}">戻る</a>
</x-layout>
