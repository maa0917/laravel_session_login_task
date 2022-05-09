<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }

        $this->user = User::create([
            'name' => 'user_name',
            'email' => 'user@email.com',
            'password' => 'password',
        ]);
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、要件通りにパスのプレフィックスが使用できること()
    {
        $this->get(route('sessions.create'))->assertStatus(200);
        $this->get(route('users.create'))->assertStatus(200);
    }

    /**
     * 画面設計要件
     * @test
     */
    public function ログアウト中の場合、要件通りにHTMLのid属性やclass属性が付与されていること、グローバルナビゲーション()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');

            $browser->assertPresent('#sign-up');
            $browser->assertPresent('#sign-in');
            $browser->assertMissing('#my-account');
            $browser->assertMissing('#sign-out');
            $browser->assertMissing('#tasks-index');
            $browser->assertMissing('#new-task');
        });
    }

    /**
     * 画面設計要件
     * @test
     */
    public function ログアウト中の場合、要件通りにHTMLのid属性やclass属性が付与されていること、ログイン画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');

            $browser->assertPresent('#create-session');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログアウト中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、グローバルナビゲーション()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');

            $browser->assertSeeLink('アカウント登録');
            $browser->assertSeeLink('ログイン');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログアウト中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、ログイン画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');

            $browser->assertSee('ログインページ');
            $browser->assertSeeIn('#email-label', 'メールアドレス');
            $browser->assertSeeIn('#password-label', 'パスワード');
            $browser->assertSeeIn('#create-session', 'ログイン');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログアウト中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、アカウント登録画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');

            $browser->assertSee('アカウント登録ページ');
            $browser->assertSeeIn('#name-label', '名前');
            $browser->assertSeeIn('#email-label', 'メールアドレス');
            $browser->assertSeeIn('#password-label', 'パスワード');
            $browser->assertSeeIn('#password-confirmation-label', 'パスワード（確認）');
            $browser->assertSeeIn('#submit-button', '登録する');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、画面遷移図通りに遷移させること、グローバルナビゲーションのリンクを要件通りに遷移させること()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');
            $browser->clickLink('ログイン');

            $browser->assertSee('ログインページ');

            $browser->clickLink('アカウント登録');
            $browser->assertSee('アカウント登録ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、画面遷移図通りに遷移させること、アカウント登録に成功した場合、ページタイトルに「タスク一覧ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->value('#name', 'new_user_name');
            $browser->value('#email', 'new_user@email.com');
            $browser->value('#password', 'new_password');
            $browser->value('#password_confirmation', 'new_password');
            $browser->press('#submit-button');

            $browser->assertSee('タスク一覧ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、画面遷移図通りに遷移させること、アカウント登録に失敗した場合、ページタイトルに「アカウント登録ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('users.create');
            $browser->value('#name', '');
            $browser->value('#email', '');
            $browser->value('#password', '');
            $browser->value('#password_confirmation', '');
            $browser->press('#submit-button');

            $browser->assertSee('アカウント登録ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、画面遷移図通りに遷移させること、ログインに成功した場合、ページタイトルに「タスク一覧ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');
            $browser->value('#email', $this->user->email);
            $browser->value('#password', 'password');
            $browser->press('#create-session');

            $browser->assertSee('タスク一覧ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログアウト中の場合、画面遷移図通りに遷移させること、ログインに失敗した場合、ページタイトルに「ログインページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('sessions.create');
            $browser->value('#email', 'failed@email.com');
            $browser->value('#password', 'failed_password');
            $browser->press('#create-session');

            $browser->assertSee('ログインページ');
        });
    }
}
