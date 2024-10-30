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
        Schema::create('todoitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('todolist_id')->constrained('todolists')->onDelete('cascade');
//            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            //$table->text('description')->nullable();
            $table->time('complete_time');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todoitems');
    }
};
