<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasOne;
//
//class Category extends Model
//{
//    protected $table = 'categories';
//    protected $primaryKey = 'id';
//    protected $fillable = [
//        'name',
//        'user_id'
//    ];
//
//    public function category(): BelongsTo
//    {
//        return $this->belongsTo(ToDoItem::class);
//    }
//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
//}
