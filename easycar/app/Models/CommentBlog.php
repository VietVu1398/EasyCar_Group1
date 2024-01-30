<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CarAccount;

class CommentBlog extends Model
{
    protected $table = "comment_blog";
    protected $fillable = ["blog_id", "account_id", "reply_id", "content", "status"];
    protected $primarykey = "id";
    public $timestamps = true;

    // check quan hệ với table CarAccount và mối quan hệ 1 với 1 
    // nghĩa là mỗi bản ghi trong bảng hiện tại chỉ có một bản ghi liên quan trong bảng car_accounts.
    public function acc()
    {
        return $this->hasOne(CarAccount::class, 'id', 'account_id');
    }

    //check quan hệ table reply
    public function replies()
    {
        return $this->hasMany(CommentBlog::class, 'reply_id', 'id');
    }

}
