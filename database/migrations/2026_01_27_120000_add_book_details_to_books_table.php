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
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedInteger('page_count')->nullable()->after('published_date');
            $table->date('purchased_date')->nullable()->after('page_count');
            $table->date('reading_started_date')->nullable()->after('purchased_date');
            $table->date('reading_finished_date')->nullable()->after('reading_started_date');
            $table->string('category')->nullable()->after('reading_finished_date');
            $table->json('tags')->nullable()->after('category');
            $table->text('reading_notes')->nullable()->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'page_count',
                'purchased_date',
                'reading_started_date',
                'reading_finished_date',
                'category',
                'tags',
                'reading_notes',
            ]);
        });
    }
};
