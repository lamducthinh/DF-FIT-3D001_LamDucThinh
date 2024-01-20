<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff';

    protected $guarded = [];

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class,'product_category_id')->withTrashed();
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}