<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryGptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'history_id',
        'my_user',
        'file_original_name',
        'content'
    ];
}
