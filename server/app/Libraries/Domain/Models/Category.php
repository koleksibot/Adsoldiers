<?php

namespace App\Libraries\Domain\Models;

use App\Libraries\Domain\Models\Library;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    
    public function libraries()
    {
        return $this->belongsToMany(Library::class, 'library_category');
    }
}
