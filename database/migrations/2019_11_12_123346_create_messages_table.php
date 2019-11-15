<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger("user_id")->index();
            $table->unsignedInteger("to_user_id")->index();
            $table->string("file",255)->nullable();
            $table->text("message")->nullable();
            $table->dateTime('seen_at')->nullable();
            $table->boolean("is_important")->default(false);
            $table->dateTime("important_message_sent_at")->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("to_user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
