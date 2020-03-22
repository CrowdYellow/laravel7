<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->comment("分类");
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->longText('body');
            $table->text('excerpt')->nullable();
            $table->integer('comment_count')->default(0)->comment('评论');
            $table->integer('good_count')->default(0)->comment('点赞');
            $table->integer('view_count')->default(0)->comment('浏览');
            $table->boolean('is_allowed_comment')->default(true)->comment('允许评论');
            $table->boolean('status')->default(true)->comment('是否显示');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
