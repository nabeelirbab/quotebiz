<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id'); // Ensure this matches the 'id' type of the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('subdomain');
            $table->text('question');
            $table->string('question_type');
            $table->string('icon')->nullable();
            $table->enum('icon_option', ['upload', 'library'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_fields');
    }
}


