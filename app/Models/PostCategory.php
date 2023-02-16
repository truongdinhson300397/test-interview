<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'category_id',
        'post_id'
    ];

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'category_id');
//    }
//
//    public function post()
//    {
//        return $this->belongsTo(Post::class, 'post_id');
//    }
}
