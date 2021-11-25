<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('message')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('from')->nullable();
            $table->foreignId('team_id')->nullable();
            $table->string('seen')->default('false');
            $table->text('link')->nullable();
            
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
        Schema::dropIfExists('notifications');
    }
}
