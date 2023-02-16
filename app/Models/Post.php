<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = [
        'id',
        'name',
    ];

    // ======================================================================
    // BEGIN: Relationship
    // ======================================================================

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id',  'category_id')->using(PostCategory::class);
    }
}
