<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    use HasFactory;
    protected $table = "history_login";
    protected $fillable = [ 'account_id', 'login_datetime','logout_datetime'];
    protected $primarykey = "id";
    public $timestamps = false;
}
