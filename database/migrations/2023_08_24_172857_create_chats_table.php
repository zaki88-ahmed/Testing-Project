<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string("content");
            $table->enum("status", [0, 1])->default(0);

            $table->bigInteger("sender_id")->unsigned();
            $table->foreign("sender_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");

            $table->bigInteger("receiver_id")->unsigned();
            $table->foreign("receiver_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
