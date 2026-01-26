<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingLog extends Model
{
    // テーブル名の指定（必要に応じて）
    protected $table = 'reading_logs';
    protected $fillable = [
        'user_id',
        'book_id',
        'date',
        'minutes_read',
        'start_page',
        'end_page',
        'memo',
        'mood',
    ];

}
