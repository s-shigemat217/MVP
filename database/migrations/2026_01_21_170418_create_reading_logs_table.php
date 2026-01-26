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
        Schema::create('reading_logs', function (Blueprint $table) {
            $table->id();

            // 外部キー設定
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();

            // ログ情報
            $table->date('date');
            $table->unsignedInteger('minutes_read')->nullable();
            $table->unsignedInteger('start_page')->nullable();
            $table->unsignedInteger('end_page')->nullable();

            // 追加情報
            $table->text('memo')->nullable();
            $table->string('mood')->nullable();

            // タイムスタンプ
            $table->timestamps();

            $table->unique(['user_id', 'book_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_logs');
    }
};
