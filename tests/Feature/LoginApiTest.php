<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function should_登録済みのユーザーを認証して返却する()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'secret',
        ]);

        $response
            ->assertStatus(200)
            // assertJsonメソッドはレスポンスを配列へ変換し、PHPUnit::assertArraySubsetを使用しアプリケーションへ戻ってきた
            // JSONレスポンスの中に、指定された配列が含まれているかを確認します
            ->assertJson(['name' => $this->user->name]);

        // 指定したユーザーが認証されていることを宣言
        $this->assertAuthenticatedAs($this->user);
    }
}
