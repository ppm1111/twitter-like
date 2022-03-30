<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App;
use App\Domain\Post\Service\CreatePostImpl;
use App\Domain\Post\Service\SharePostImpl;
use App\Domain\Post\Service\FavoritePostImpl;
use App\Domain\Post\Service\FollowUserImpl;
use App\Domain\Post\Service\StarPostImpl;
use App\Models\Post;
use App\Models\User;
use App\Exceptions\ForbidenException;
use App\Models\SharePost;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp() : void
    {
        parent::setUp();
        $this->seed();
    }

    // 不能分享給自己
    /**
    * @expectedException ForbidenException
    */
    public function test_share_post_to_myself()
    {
        $post = Post::factory()->create();
        $service = App::make(SharePostImpl::class);
        $users = User::all();
        $fromUserId = $users->get(0)->id;
        $toUserId = $users->get(0)->id;

        $this->expectException(ForbidenException::class);
        $service->share($post->id, $fromUserId, $toUserId);
    }

    // 不能重複喜歡一個 post
    public function test_favorite_twice()
    {
        $post = Post::factory()->create();
        $service = App::make(FavoritePostImpl::class);
        $userId = User::first()->id;

        $this->expectException(ForbidenException::class);
        $service->favorite($post->id, $userId);
        $service->favorite($post->id, $userId);
    }

    // 不能跟隨給自己
    public function test_follow_myself()
    {
        $post = Post::factory()->create();
        $service = App::make(FollowUserImpl::class);
        $users = User::all();
        $fromUserId = $users->get(0)->id;
        $toUserId = $users->get(0)->id;

        $this->expectException(ForbidenException::class);
        $post = $service->follow($fromUserId, $toUserId);
    }

    // 不能重複star post
    public function test_already_star_post()
    {
        $post = Post::factory()->create();
        $service = App::make(StarPostImpl::class);
        $userId = User::first()->id;

        $this->expectException(ForbidenException::class);
        $service->star($post->id, $userId);
        $service->star($post->id, $userId);
    }

    // 測試是否能增加 star 數量
    public function test_star_post()
    {
        $post = Post::factory()->create();
        $service = App::make(StarPostImpl::class);
        $userId = User::first()->id;

        $service->star($post->id, $userId);
        $post = Post::find($post->id);

        $this->assertTrue($post->star == 1);
    }
}
