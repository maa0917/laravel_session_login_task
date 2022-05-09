<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、要件通りにパスのプレフィックスが使用できること()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);

            $browser->visitRoute('users.show', $this->user);
            $browser->assertPathIs("/users/{$this->user->id}");

            $browser->visitRoute('users.edit', $this->user);
            $browser->assertPathIs("/users/{$this->user->id}/edit");
        });
    }

    /**
     * 画面設計要件
     * @test
     */
    public function ログイン中の場合、要件通りにHTMLのid属性やclass属性が付与されていること、グローバルナビゲーション()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('/');

            $browser->assertPresent('#my-account');
            $browser->assertPresent('#sign-out');
            $browser->assertPresent('#tasks-index');
            $browser->assertPresent('#new-task');
            $browser->assertMissing('#sign-up');
            $browser->assertMissing('#sign-in');
        });
    }

    /**
     * 画面設計要件
     * @test
     */
    public function ログイン中の場合、要件通りにHTMLのid属性やclass属性が付与されていること、アカウント詳細画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.show', $this->user);

            $browser->assertPresent('#edit-user');
            $browser->assertPresent('#destroy-user');
        });
    }

    /**
     * 画面設計要件
     * @test
     */
    public function ログイン中の場合、要件通りにHTMLのid属性やclass属性が付与されていること、アカウント編集画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.edit', $this->user);

            $browser->assertPresent('#back');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログイン中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、グローバルナビゲーション()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('/');

            $browser->assertSeeLink('タスク一覧');
            $browser->assertSeeLink('タスクを登録する');
            $browser->assertSeeLink('アカウント');
            $browser->assertSeeLink('ログアウト');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログイン中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、アカウント詳細画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.show', $this->user);

            $browser->assertSee('アカウント詳細ページ');
            $browser->assertSee('名前');
            $browser->assertSee('メールアドレス');
            $browser->assertSeeLink('編集');
            $browser->assertSeeLink('削除');
        });
    }

    /**
     * 画面要件
     * @test
     */
    public function ログイン中の場合、要件通りに各画面に文字やリンク、ボタンを表示すること、アカウント編集画面()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.edit', $this->user);

            $browser->assertSee('アカウント編集ページ');
            $browser->assertSeeIn('#name-label', '名前');
            $browser->assertSeeIn('#email-label', 'メールアドレス');
            $browser->assertSeeIn('#password-label', 'パスワード');
            $browser->assertSeeIn('#password-confirmation-label', 'パスワード（確認）');
            $browser->assertSeeIn('#submit-button', '更新する');
            $browser->assertSeeLink('戻る');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、グローバルナビゲーションのリンクを要件通りに遷移させること()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('/');

            $browser->clickLink('タスク一覧');
            $browser->assertSee('タスク一覧ページ');

            $browser->clickLink('タスクを登録する');
            $browser->assertSee('タスク登録ページ');

            $browser->clickLink('アカウント');
            $browser->assertSee('アカウント詳細ページ');

            $browser->clickLink('ログアウト');
            $browser->assertSee('ログインページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、アカウント詳細画面の「編集」をクリックした場合、ページタイトルに「アカウント編集ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.show', $this->user);

            $browser->clickLink('編集');
            $browser->assertSee('アカウント編集ページ');

        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、アカウント詳細画面の「削除」をクリックした場合、ページタイトルに「ログインページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.show', $this->user);

            $browser->clickLink('削除');
            $browser->assertDialogOpened('本当に削除してもよろしいですか？');

            $browser->acceptDialog();
            $browser->assertSee('ログインページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、アカウントの編集に成功した場合、ページタイトルに「アカウント詳細ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.edit', $this->user);

            $browser->value('#name', 'edit_user_name');
            $browser->value('#email', 'edit_user@email.com');
            $browser->value('#password', 'edit_password');
            $browser->value('#password_confirmation', 'edit_password');
            $browser->press('#submit-button');

            $browser->assertSee('アカウント詳細ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、アカウントの編集に失敗した場合、ページタイトルに「アカウント編集ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.edit', $this->user);

            $browser->value('#name', '');
            $browser->value('#email', '');
            $browser->value('#password', '');
            $browser->value('#password_confirmation', '');
            $browser->press('#submit-button');

            $browser->assertSee('アカウント編集ページ');
        });
    }

    /**
     * 画面遷移要件
     * @test
     */
    public function ログイン中の場合、画面遷移図通りに遷移させること、アカウント編集画面の「戻る」をクリックした場合、ページタイトルに「アカウント詳細ページ」が表示される()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user);
            $browser->visitRoute('users.edit', $this->user);

            $browser->clickLink('戻る');

            $browser->assertSee('アカウント詳細ページ');
        });
    }
}
