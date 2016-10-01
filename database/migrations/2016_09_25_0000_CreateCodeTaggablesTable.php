<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeTaggablesTable extends Migration
{
    public function up()
    {
        Schema::create('codepress_taggables', function (Blueprint $table) {
            $table->integer('tag_id');
            $table->integer('taggable_id');
            $table->string('taggable_type');
        });
    }

    public function down()
    {
        Schema::drop('codepress_taggables');
    }
}