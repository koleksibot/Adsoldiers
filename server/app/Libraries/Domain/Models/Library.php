<?php

namespace App\Libraries\Domain\Models;

use App\Libraries\Domain\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['media' => 'array'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'library_category', 'library_id', 'Category_id');
    }
}
