<?php
// app/Models/Coupon.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model 
{
    use HasFactory;
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'coupon_course');
    }
}
