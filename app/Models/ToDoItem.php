<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ToDoItem extends Model
{
    protected $table = 'todoitems';
    protected $primaryKey = 'id';
    protected $fillable = [
//        'category_id',
        'completed',
//        'description',
        'complete_time',
        'name',
        'todolist_id'
    ];
    public function list(): BelongsTo
    {
        return $this->belongsTo(ToDoList::class);
    }

//    public function category(): HasOne
//    {
//        return $this->hasOne(Category::class);
//    }
}
