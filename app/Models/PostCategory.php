<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategory extends Pivot
{
    use HasFactory, TraitUuid;

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
