<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_post', function (Blueprint $table) {

            $table->bigInteger("page_id")->unsigned();
            $table->foreign("page_id")->references("id")->on("pages")->onDelete("cascade")->onUpdate("cascade");

            $table->bigInteger("post_id")->unsigned();
            $table->foreign("post_id")->references("id")->on("posts")->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('page_post');
    }
}
