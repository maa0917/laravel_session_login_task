<x-layout>
    <h1>アカウント登録ページ</h1>

    <x-users.form user="">
        <x-slot name="action">{{ route('users.store') }}</x-slot>

        <x-slot name="method">post</x-slot>

        <x-slot name="submit">登録する</x-slot>
    </x-users.form>
</x-layout>
