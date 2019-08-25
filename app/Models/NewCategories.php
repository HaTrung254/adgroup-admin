<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewCategories extends Model
{
    protected $table = 'new_categories';
    public $timestamps = false;
    public $fillable = ['vn_title', 'en_title'];
}
