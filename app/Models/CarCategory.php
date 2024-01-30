<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarProduct;




class CarCategory extends Model
{
    protected $table = "car_type";
    protected $fillable = ["name", "description", "image_type", "type_status"];
    protected $primarykey = "id";
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(CarProduct::class, 'type_id', 'id');
    }

}
