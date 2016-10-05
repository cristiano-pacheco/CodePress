<?php


namespace CodePress\CodePost\Tests;


use CodePress\CodePost\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminPostsTest extends \TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    public function test_can_visit_admin_posts_page()
    {
        $this->visit('/admin/posts')
            ->see('Posts');
    }

    public function test_verify_posts_listing()
    {
        Post::create(['title' => 'Post 1', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 2', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 3', 'content' => 'Post Content']);
        Post::create(['title' => 'Post 4', 'content' => 'Post Content']);

        $this->visit('/admin/posts')
            ->see('Post 1')
            ->see('Post 2')
            ->see('Post 3')
            ->see('Post 4');
    }

    public function test_click_create_new_post()
    {
        $this->visit('/admin/posts')
            ->click('Create Post')
            ->seePageIs('/admin/posts/create')
            ->see('Create Post');
    }

    public function test_create_new_post()
    {
        $this->visit('/admin/posts/create')
            ->type('Post Test', 'title')
            ->type('Content Test', 'content')
            ->press('Submit')
            ->seePageIs('/admin/posts')
            ->see('Post Test');
    }

    public function test_click_edit_post()
    {
        $post = $this->createAPost();

        $this->visit('/admin/posts')
            ->click('Edit')
            ->seePageIs('/admin/posts/'.$post->id.'/edit')
            ->see('Post 1')
            ->see('Post Content');
    }

    public function test_update_post()
    {
        $post = $this->createAPost();

        $this->visit('/admin/posts/'.$post->id.'/edit')
            ->type('Post Test 2', 'title')
            ->type('Content Test 2', 'content')
            ->press('Submit')
            ->seePageIs('/admin/posts')
            ->see('Post Test 2');
    }

    public function test_delete_post()
    {
        $post = $this->createAPost();

        $this->visit('/admin/posts/'.$post->id.'/delete')
            ->dontSee('Post 1');
    }

    public function createAPost()
    {
        return Post::create(['title' => 'Post 1', 'content' => 'Post Content']);
    }

    public function test_show_deleted_post()
    {
        $post = $this->createAPost();
        $post->delete();

        $this->visit('/admin/posts')
            ->see('Posts')
            ->dontSee('Post 1');

        $this->visit('/admin/posts/deleted')
            ->see('Posts Deleted')
            ->see('Post 1');
    }
}