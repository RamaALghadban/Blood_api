<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donate_schedual extends Model
{
    use HasFactory;
    protected $fillable = [
 "user_id",
 "amount",
 "blood_type_id",
 "verified",
    ];

    public function user()
    {
        return $this->belongsTo(user::class,"user_id");
    }
    public function BloodType()
    {
        return $this->belongsTo(BloodType::class,"blood_type_id");
    }
}
