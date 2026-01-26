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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // 認証は未実装だが、将来的にユーザ管理をするならコメントアウトを外す
            // $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // 書誌情報
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->string('published_date')->nullable();
            $table->text('cover_image_url')->nullable();

            // 所持状態
            $table->string('status')->default('owned'); // owned / wishlist

            // API連携・重複防止のためのフィールド
            $table->string('isbn')->nullable()->index();
            $table->string('source')->nullable();     // google_books / openbd
            $table->string('source_id')->nullable();  // volumeId 等

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
