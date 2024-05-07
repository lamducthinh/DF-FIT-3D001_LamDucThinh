<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'check_in_time',
    
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    
}
