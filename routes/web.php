<?php


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\ErrorTrackingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Developer\DeveloperHomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});


Route::group(['prefix' => 'admin'], function () {


    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::get('/otp-login', [LoginController::class, 'otpLogin'])->name('admin.otpLogin');
        Route::post('/otp-generate', [LoginController::class, 'generateOtp'])->name('admin.generateOtp');
        Route::get('/otp-verify/{id}', [LoginController::class, 'otpVerify'])->name('admin.otpVerify');
        Route::get('/otp-verify-forgetPassword/{id}', [LoginController::class, 'otpVerifyForgetPassword'])->name('admin.otpVerifyForgetPassword');
        Route::get('/otp-changePassword', [LoginController::class, 'otpChangePassword'])->name('admin.otpChangePassword');
        Route::post('/otp-register', [LoginController::class, 'otpRegister'])->name('admin.otpRegister');
        Route::post('/otp-changePassword', [LoginController::class, 'otpStorePassword'])->name('admin.otpStorePassword');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        // Route::post('/news/store', [HomeController::class, 'store'])->name('news.store');
        Route::get('/download-pdf', [HomeController::class, 'downloadPDF'])->name('admin.downloadPDF');
        Route::get('/download-news/{url}', [HomeController::class, 'news_Pdf'])->name('admin.news_Pdf')->where('url', '.*');
        // Route::get('/download-pdf', [HomeController::class, 'downloadPDF'])->name('admin.downloadPDF');

        Route::get('get-keywords-by-category/{category_id}', [HomeController::class, 'getKeywordsByCategory'])->name('get.keywords.by.category');






        //new
        Route::post('/news', [HomeController::class, 'store'])->name('news.index');
        Route::get('/news', [HomeController::class, 'store'])->name('news.index');
        Route::get('/news/update-categories', [HomeController::class, 'showUpdateCatPage'])->name('news.update_category');
        Route::post('/news/update-categories', [HomeController::class, 'updateCategories'])->name('news.update-categories');

        Route::get('/news-all', [HomeController::class, 'store_all'])->name('news.all');
        Route::post('news/save', [HomeController::class, 'save'])->name('news.save');
        Route::get('/news-list', [HomeController::class, 'list'])->name('news.list');
        Route::get('/news/pdf', [HomeController::class, 'generatePDF'])->name('news.pdf');

        Route::post('/news/update-title/{id}', [HomeController::class, 'updateTitle'])->name('news.update-title');
        Route::post('/news/update-source/{id}', [HomeController::class, 'updateSource'])->name('news.update-source');
        Route::delete('admin/news/{id}', [HomeController::class, 'destroy'])->name('news.destroy');
        Route::post('/news/reorder', [HomeController::class, 'reorder'])->name('news.reorder');


        //admin
        Route::get('/profile-edit', [LoginController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/profie-update/{id}', [LoginController::class, 'update'])->name('admin.profile.update');

        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');



        //-----------------------------------------------------

        Route::resource('developers', DeveloperController::class);

        Route::resource('projects', ProjectController::class);
        Route::resource('error_trackings', ErrorTrackingController::class);

        Route::resource('users', UserController::class);
    });
});



// Route::group(['prefix' => 'developer'], function () {
//     // Routes for members
//     Route::group(['middleware' => 'developer.guest'], function () {
//         Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
//         Route::post('/developer/authenticate', [LoginController::class, 'authenticate'])->name('member.authenticate');
//     });

//     Route::group(['middleware' => 'developer.auth'], function () {

//         Route::get('/developer/dashboard', [DeveloperHomeController::class, 'index'])->name('member.dashboard');
//         Route::get('/manager-masterdata', [DeveloperHomeController::class, 'masterdata_index'])->name('member.masterdata');
//         Route::get('/funding-expense', [DeveloperHomeController::class, 'fundingExpense'])->name('member.fundingExpense');
//         Route::get('/manager-reports', [DeveloperHomeController::class, 'reports_index'])->name('member.reports');
//         Route::get('/manager-local-purchase', [DeveloperHomeController::class, 'purchase_page'])->name('member.purchase');
//         Route::get('/manager-calender', [DeveloperHomeController::class, 'calender'])->name('member.calender');
//         Route::get('/manager-list-by-date', [DeveloperHomeController::class, 'listByDate'])->name('member.listByDate');
//         Route::get('/manager-user-list-by-date', [DeveloperHomeController::class, 'userListByDate'])->name('member.userListByDate');
//         Route::post('/manager-users/change-status', [DeveloperHomeController::class, 'changeStatus'])->name('member.users.changeStatus');
//         Route::get('/manager-list', [DeveloperHomeController::class, 'index'])->name('member.users.list');

//         //member
//         Route::get('/manager-profile-edit', [LoginController::class, 'manager_edit'])->name('member.profile.edit');
//         Route::put('/manager-profie-update/{id}', [LoginController::class, 'manager_update'])->name('member.profile.update');

//     });
// });