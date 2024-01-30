<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerADS extends Model
{
    use HasFactory;
    protected $table = "ads_banners";
    protected $fillable = ['banner_name', 'images', 'Content','Status'];
    protected $primarykey = "id";
    public $timestamps = false;
}

