<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'parent_id'];


    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id', 'id');
    }


    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }
}