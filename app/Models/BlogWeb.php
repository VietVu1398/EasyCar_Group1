<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogWeb extends Model
{
    protected $table = "blogs";
    protected $fillable = ["title", "images", "content", "status"];
    protected $primarykey = "id";
    public $timestamps = true;
    // viết lệnh truy vấn thông qua hàm dưới đây gọi ra bên Controller cho gọn
    //và đang gán chỉ lấy tối thiểu 2 có thể thay đổi giá trị này bên đây vs bên HomeController
    public function scopeNewBlog($query, $limit = 4)
    {
        $query = $query->where('status', 1)->orderBy('created_at', 'DESC')->limit(4);
    }
    //lấy blog_id bên bảng CommentBlog qua quan hệ với id BloogWeb để hiện các bình luận con và sort theo thứ tự mới nhất
    // public function comments(){
    //     return $this->hasMany(CommentBlog::class, 'blog_id', 'id')->orderBy('id', 'DESC');
    // }
    // đang sử dụng hasMany là mối quan hệ 1 nhiều: 1 blog có thể có nhiều comment
    // điều kiện lấy theo reply_id và không phải là 0 sẽ lấy ra
    public function comments()
    {
        return $this->hasMany(CommentBlog::class, 'blog_id', 'id')->where('reply_id', 0)->orderBy('id', 'DESC');
    }
}
