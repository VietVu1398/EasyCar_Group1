<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_Car extends Model
{
    protected $table = "comments_car";
    protected $fillable = ["account_id", "car_id", "comment", "reply", "status"];
    protected $primarykey = "id";
    public $timestamps = true;

    // lấy quan hệ theo tham chiếu đến bảng account
    public function account()
    {
        // dùng câu truy vấn belongsTo để lấy mối liên hệ cột account_id
        // trong bảng comments_car đến bảng cha account chứa thông tin account đó
        // cột account_id bảng comments_car chiếu đến bảng account có chứ id 
        return $this->belongsTo(CarAccount::class, 'account_id', 'id');
    }
    
    public function car()
    {
        return $this->belongsTo(CarProduct::class, 'car_id');
    }

    

}
