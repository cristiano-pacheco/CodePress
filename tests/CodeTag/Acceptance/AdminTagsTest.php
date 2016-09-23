<?php


namespace CodePress\CodeTag\Tests;


use CodePress\CodeTag\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCategoriesTest extends \TestCase
{
    use DatabaseMigrations;

    public function test_can_visit_admin_tags_page()
    {
        $this->visit('/admin/tags')
            ->see('Tags');
    }

    public function test_verify_tags_listing()
    {
        Tag::create(['name' => 'Tag 1']);
        Tag::create(['name' => 'Tag 2']);
        Tag::create(['name' => 'Tag 3']);
        Tag::create(['name' => 'Tag 4']);

        $this->visit('/admin/tags')
            ->see('Tag 1')
            ->see('Tag 2')
            ->see('Tag 3')
            ->see('Tag 4');
    }

    public function test_click_create_new_tag()
    {
        $this->visit('/admin/tags')
            ->click('Create Tag')
            ->seePageIs('/admin/tags/create')
            ->see('Create Tag');
    }

    public function test_create_new_tag()
    {
        $this->visit('/admin/tags/create')
            ->type('Tag Test', 'name')
            ->press('Submit')
            ->seePageIs('/admin/tags')
            ->see('Tag Test');
    }

    public function test_edit_tag()
    {
        $tag = Tag::create(['name' => 'Tag 1']);

        $this->visit('/admin/tags/'.$tag->id.'/edit')
            ->type('Tag Test 2', 'name')
            ->press('Submit')
            ->seePageIs('/admin/tags')
            ->see('Tag Test 2');
    }

    public function test_delete_tag()
    {
        $tag = Tag::create(['name' => 'Tag 1']);

        $this->visit('/admin/tags/'.$tag->id.'/delete')
            ->dontSee('Tag 1');
    }
}