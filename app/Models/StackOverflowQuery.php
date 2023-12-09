<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackOverflowQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagged',  'to_date', 'from_date', 'result'
    ];
}
