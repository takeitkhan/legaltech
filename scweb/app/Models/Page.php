<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'hero_title',
        'hero_subtitle',
        'statistic_one_number',
        'statistic_one_title',
        'statistic_two_number',
        'statistic_two_title',
        'statistic_three_number',
        'statistic_three_title',
        'statistic_four_number',
        'statistic_four_title',
        'hero_image',
        'description'
    ];
}
