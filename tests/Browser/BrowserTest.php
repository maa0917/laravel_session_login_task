<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class BrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * 画面遷移要件
     * ログアウト中の場合
     * @test
     */
    public function 要件通りにパスのプレフィックスが使用できること()
    {
        $this->get(route('sessions.create'))->assertStatus(200);
        $this->get(route('users.create'))->assertStatus(200);
    }
}
