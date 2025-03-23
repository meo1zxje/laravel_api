<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('title');
            $table->text('content');
            $table->string('image');
            $table->string('status')->default("pending");
            $table->integer('id_author')->unsigned();
            $table->integer('id_subitem')->unsigned();
            $table->timestamps();

            $table->foreign('id_author')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('id_subitem')->references('id')->on('subitems')->onDelete('RESTRICT')->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
