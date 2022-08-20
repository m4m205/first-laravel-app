<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoitem extends Model
{
    use HasFactory;

    // Relationship To todolist
    public function user()
    {
        return $this->belongsTo(todolist::class, 'list_id');
    }
}
