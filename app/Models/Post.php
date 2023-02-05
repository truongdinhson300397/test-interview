<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, TraitUuid;
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
