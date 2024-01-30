<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = "bill_detail";
    protected $fillable = ["rental_id", "payment_method", "total_amount", "paid","note"];
    protected $primarykey = "id";
    public $timestamps = true;
}
