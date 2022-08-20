<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolist extends Model
{
    use HasFactory;

    // Relationship With todoitem
    public function todoItem()
    {
        return $this->hasMany(todoitem::class, 'list_id');
    }

    // Relationship With User
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
