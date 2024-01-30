<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRating extends Model
{
    protected $table = "ratings";
    protected $fillable = ["account_id", "car_id", "stars_rated"];
    protected $primarykey = "id";
    public $timestamps = true;
    public function ratings()
    {
        return $this->hasMany(CarRating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('stars_rated');
    }
    // thêm khoá ngoại table account
    public function carAccount()
    {
        return $this->belongsTo(CarAccount::class, 'account_id', 'id');

    }

    // thêm khoá ngoại table cars
    public function car()
    {
        return $this->belongsTo(CarProduct::class, 'car_id');
    }

   
}