<?php

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{
    use DatabaseMigrations;
    public function AddTextPostTest()
    {
        $post = factory(Post::class)->create(['user_id'=>'5',
            'body'=>'Hello']);
        $user = factory(User::class)->create(['name'=>'Mawada']);


        $test = $user->posts()->save($post);
        
        $this->assertTrue(true, $test);
    }
}