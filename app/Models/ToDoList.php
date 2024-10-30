<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ToDoList extends Model
{
    protected $table = 'todolists';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'user_id',
        'complete_date'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ToDoItem::class,'todolist_id', 'id')->orderBy('complete_time');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
