<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shift extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='shifts';
    protected $fillable = ['name', 'start_time', 'end_time'];
    public function schedules(){
        return $this->hasMany(Schedule::class,'shift_id')->withTrashed();
    }
}
