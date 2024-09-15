<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoModels extends Model
{
    use HasFactory;
    protected $table = 'user_information';
    protected $fillable = [
        'text',
    ];
}
