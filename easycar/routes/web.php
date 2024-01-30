<?php

use Illuminate\Support\Facades\Route;
// Route FE
use App\Http\Controllers\fe\RentalController;
use App\Http\Controllers\fe\CarRatingController;
use App\Http\Controllers\fe\CarAccountController;
use App\Http\Controllers\fe\AjaxLoginController;

// Route BE
use App\Http\Controllers\fe\HomeController;
use App\Http\Controllers\be\AdminController;
use App\Http\Controllers\be\CategoryController;
use App\Http\Controllers\be\ProductController;
use App\Http\Controllers\be\ParentController;
use App\Http\Controllers\be\AccountController;
use App\Http\Controllers\be\BannerController;
use App\Http\Controllers\be\BeCarRatingController;
use App\Http\Controllers\be\RentalManagement;
use App\Http\Controllers\be\UserLoginHistoryController;
use App\Http\Middleware\PhanQuyen;
use App\Http\Controllers\be\BlogController;
use App\Http\Controllers\be\CommentBlogController;
use App\Http\Controllers\be\CommentCarController;
use App\Http\Controllers\be\FeedbackController;




//======= WEBSITE FRONTEND ===============
//Home Page:
Route::match(['get', 'post'], '/', [HomeController::class, 'home'])->name('fe.home');
Route::get('/about-us', [HomeController::class, 'aboutus'])->name('fe.aboutus');
Route::match(['get', 'post'], '/contact-us', [HomeController::class, 'contactus'])->name('fe.contactus');

// BLOGS
//Blogs
Route::get("/list-blogs", [HomeController::class, 'listblogs'])->name("fe.listblogs");
//Blog Detail
Route::get('/blog/{blog}-{slug}', [HomeController::class, 'blogWeb'])->name('fe.blogweb');
// login ajax chỗ Blogs 
// Route login
Route::post('/login-ajax', [AjaxLoginController::class, 'loginajax'])->name('ajax.login');
// comment
Route::post('/comment-blog/{blog_id}', [AjaxLoginController::class, 'comment'])->name('ajax.commentBlog');
// logout
Route::get("/logout-ajax", [AjaxLoginController::class, 'logoutajax'])->name('ajax.logout');



// ROUTE FOR USER
//Register
Route::match(['get', 'post'], '/register', [CarAccountController::class, 'register'])->name('fe.register');
// Route login
Route::match(['get', 'post'], '/login', [CarAccountController::class, 'login'])->name('fe.login');
// logout
Route::get("/logout.html", [CarAccountController::class, 'logout'])->name('fe.logout');
//forget password
Route::match(['get', 'post'], "/forget.html", [CarAccountController::class, 'forgetpass'])->name('fe.forgetpass');
//profile_user update
Route::match(['get', 'post'], '/profile-user', [HomeController::class, 'profile_user'])->name('fe.profile_user');
// Rental History
Route::get("/booking-history", [CarAccountController::class, 'bookinghistory'])->name('fe.bookinghistory');



// ROUTE FOR PRODUCT
// route category
Route::get("/category/{key}", [HomeController::class, 'category'])->name("fe.category");
// route detail
Route::match(['get', 'post'], "/detail-car/{name}/{key}", [HomeController::class, 'detail'])->name("fe.detail");
// Comment Car
// Sử dụng dấu chấm hỏi trong reply_id để định nghĩa rằng nếu không có mặc định là null nếu có sẽ lấy
Route::post('/comment/{id}', [HomeController::class, 'post_comment'])->name('fe.comment_car');
Route::post('/reply-comment/{id}', [HomeController::class, 'replies'])->name('fe.reply_car');
Route::get("/comment/del/{id}", [HomeController::class, 'del_comment'])->name("fe.delete_car");
//Rating
Route::post('/rating/{key}/', [CarRatingController::class, 'rate'])->name('fe.rate');
Route::get('/rate/{car}/form', [CarRatingController::class, 'showRatingForm'])->name('showRatingForm');



// ROUTE RENTAL
// Search
Route::match(['get', 'post'], '/search/{pk?}/{rt?}/{ct?}', [RentalController::class, 'search'])->name('fe.search');
//Rental Order Page
Route::match(['get', 'post'], '/rental', [RentalController::class, 'rental'])->name('fe.rental');
//Payment Page
Route::match(['get', 'post'], '/payment', [RentalController::class, 'payment'])->name('fe.payment');
//Redirect to VNPAY
Route::match(['get', 'post'], '/paymentvnpay', [RentalController::class, 'paymentvnpay'])->name('fe.paymentvnpay');
//Thong bao
Route::get('/noti', [RentalController::class, 'noti'])->name('fe.noti');




//========================SYSTEM: BACKEND =================================


Route::middleware(PhanQuyen::class)->prefix('system')->group(function () {
   //Main
   Route::get('/', [AdminController::class, 'index'])->name('be.main');

   //Admin Profile
   Route::match(['get', 'post'], '/admin/profile', [AdminController::class, 'profile'])->name('be.admin.profile');

   //Account
   // page account
   Route::get("/account", [AccountController::class, 'index'])->name("be.account");
   Route::get("/account/viewMod", [AccountController::class, 'viewMod'])->name("be.account.viewMod");
   Route::match(['get', 'post'], '/account/edit/{key}', [AccountController::class, 'edit'])->name('be.accountedit');
   // route trang add user
   Route::match(['get', 'post'], 'account/add.html', [AccountController::class, 'add'])->name('be.accountadd');
   // History login user
   Route::get("/historylogin", [AccountController::class, 'historylogin'])->name("be.historylogin");
   //Delete account
   Route::get("/account/del/{key}", [AccountController::class, 'del'])->name("be.accountdel");


   // CATEGORY
   // page category
   Route::get("/category", [CategoryController::class, 'index'])->name("be.category");
   // route trang add category chạy 2 phương thức get post cùng lúc bằng match
   Route::match(['get', 'post'], 'category/add.html', [CategoryController::class, 'add'])->name('be.categoryadd');
   // route trang Update category chạy 2 phương thức get post cùng lúc bằng match
   Route::match(['get', 'post'], 'category/edit/{key}.html', [CategoryController::class, 'edit'])->name('be.categoryedit');
   // delete route
   Route::get("/category/del/{key}", [CategoryController::class, 'del'])->name("be.categorydel");
   // change status
   Route::get("/change-type/{key}", [CategoryController::class, 'statusType'])->name("be.statusType");



   //PRODUCT
   // Route Products
   Route::get("/product", [ProductController::class, "index"])->name("be.product");
   // route add product
   Route::match(['get', 'post'], 'product/add.html', [ProductController::class, 'add'])->name('be.productadd');
   // route edit product
   Route::match(['get', 'post'], 'product/edit/{key}.html', [ProductController::class, 'edit'])->name('be.productedit');
   // route delete product
   Route::get("/product/del/{key}.html", [ProductController::class, 'del'])->name("be.productdel");
   //Download QR_Code
   Route::get("/download/qrcode/{filename}", [ProductController::class, 'downloadQRCode'])->name("download.qrcode");
   // Change Status Car
   Route::get("/status-car/{key}", [ProductController::class, "statusCar"])->name("be.changeStatusCar");
   //Rating
   Route::get("/rating", [BeCarRatingController::class, "rating"])->name("be.rating");


   //Blog_Web
   // Route blogs
   Route::get("/blog", [BlogController::class, "index"])->name("be.blogWeb");
   // route add blog
   Route::match(['get', 'post'], 'blog/add', [BlogController::class, 'addnew'])->name('be.blogadd');
   // route edit blog
   Route::match(['get', 'post'], 'blog/edit/{key}', [BlogController::class, 'edit'])->name('be.blogedit');
   // route delete blog
   Route::get("/blog/del/{key}.html", [BlogController::class, 'del'])->name("be.blogdel");
   // Change Status Blog
   Route::get("/status-blog/{key}.html", [BlogController::class, 'statusBlog'])->name("be.statusBlog");

   //Comment_Blog
   // Route Comment_Blog
   Route::get("/comment-blog", [CommentBlogController::class, "index"])->name("be.commentBlog");
   // route delete Comment_Blog
   Route::get("/change-status-blog/{key}.html", [CommentBlogController::class, 'status_CommentBlog'])->name("be.statusCommentBlog");
   // route delete product
   Route::get("/delete-status/{key}.html", [CommentBlogController::class, 'del_statusComment'])->name("be.delstatusComment");


   //Comment_Car
   // Route Comment_Car
   Route::get("/comment-car", [CommentCarController::class, "index"])->name("be.commentCar");
   // route Reply_Comment 
   Route::post("/reply-comment", [CommentCarController::class, "replyCommentCar"])->name("be.replycomment");
   // route change status
   Route::get("/changeStatus/{key}.html", [CommentCarController::class, 'statusComment'])->name("be.statusComment");
   // route delete
   Route::get("/delete-comment-car/{key}", [CommentCarController::class, "delcomment"])->name("be.delCommentCar");


   //Feedback:
   Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('be.feedback');
   Route::get('/feedbackdetail/{id}', [FeedbackController::class, 'feedbackdetail'])->name('be.feedbackdetail');
   Route::post('/mailfeedbacks/{id}', [FeedbackController::class, 'mailfeedback'])->name('be.mailfeedback');
   Route::get('/feedbacks/del/{id}', [FeedbackController::class, 'delfeedback'])->name('be.delfeedback');



   // Rental & Bills
   // List Rental order
   Route::get('/rental', [RentalManagement::class, 'index'])->name('be.rental');
   // Order Detail 
   Route::match(['get', 'post'], '/rental/detail/id={id}', [RentalManagement::class, 'detail'])->name('be.rental-detail');
   // Add new order 
   Route::match(['get', 'post'], '/rental/add-new', [RentalManagement::class, 'addnew'])->name('be.rental-add');
   //Delete order
   Route::get('/rental/del/{key}', [RentalManagement::class, 'del'])->name('be.rental-del');
   //List Bill
   Route::get('/bill', [RentalManagement::class, 'indexbill'])->name('be.bill');
   // Finish payment when user pick up car 
   Route::get('/finishpay/{key}', [RentalManagement::class, 'finishpay'])->name('be.finishpay');
   // Banner
   Route::get('/banner', [BannerController::class, 'index'])->name('be.banner');
   Route::match(['get', 'post'], '/add-banner', [BannerController::class, 'addbanner'])->name('be.addBanner');
   Route::match(['get', 'post'], '/edit-banner/{key}', [BannerController::class, 'editbanner'])->name('be.editBanner');
   Route::get("/delete-banner/{key}.html", [BannerController::class, 'del'])->name("be.delBanner");

});
















// // Category
// // page category
// Route::get("/category", [CategoryController::class, 'index'])->name("be.category");
// // route trang add category chạy 2 phương thức get post cùng lúc bằng match
// Route::match(['get', 'post'], 'category/add.html', [CategoryController::class, 'add'])->name('be.categoryadd');
// // route trang Update category chạy 2 phương thức get post cùng lúc bằng match
// Route::match(['get', 'post'], 'category/edit/{key}.html', [CategoryController::class, 'edit'])->name('be.categoryedit');
// // delete route
// Route::get("/category/del/{key}.html", [CategoryController::class, 'del'])->name("be.categorydel");

// //Product
// // Route Products
// Route::get("/product", [ProductController::class, "index"])->name("be.product");
// // route add product
// Route::match(['get', 'post'], 'product/add.html', [ProductController::class, 'add'])->name('be.productadd');
// // route edit product
// Route::match(['get', 'post'], 'product/edit/{key}.html', [ProductController::class, 'edit'])->name('be.productedit');
// // route delete product
// Route::get("/product/del/{key}.html", [ProductController::class, 'del'])->name("be.productdel");

// //Download QR_Code
// Route::get("/download/qrcode/{filename}", [ProductController::class, 'downloadQRCode'])->name("download.qrcode");
//Rating
// Route::get("/rating", [BeCarRatingController::class, "rating"])->name("be.rating");
