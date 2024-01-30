<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedbacks";
    protected $fillable = ["fullname", "email", "phone", "content","reply_status", 
                            "reply_content"];
    protected $primarykey = "id";
    public $timestamps = true;
}
