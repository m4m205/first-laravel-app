<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoitem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'completed'];
    protected $casts = ['completed' => 'boolean'];

    // Relationship To todo
    public function todo()
    {
        return $this->belongsTo(todo::class, 'list_id');
    }
}
