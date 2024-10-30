<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SharedWith extends Model
{
    protected $table = 'sharedwith';
    protected $primaryKey = 'id';
    protected $fillable = [
        'todolist_id',
        'user_id'
    ];
}
