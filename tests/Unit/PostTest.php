<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Post\Service\CreatePostImpl;
use App;

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

    public function test_create_post()
    {
        $service = App::make(CreatePostImpl::class);
        $userId = 1;
        $text = 'test';

        $post = $service->create($userId, $text);

        $this->assertTrue($text == $post->text);
    }
}
