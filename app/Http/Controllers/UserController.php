<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->all());
        Auth::login($user);

        return redirect()->route('tasks.index')->with('notice', 'アカウントを登録しました');
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->all());

        return redirect()->route('users.show', $user)->with('notice', 'アカウントを更新しました');
    }
}
