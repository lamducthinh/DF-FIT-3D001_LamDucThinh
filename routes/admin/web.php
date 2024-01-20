<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\DashBoardAdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\service\VNPayService;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware('check.is.admin')->name('admin.')->group(function(){
    Route::controller(ProductCategoryController::class)->group(function(){
        // Route::get('product_category','index')->name('product_category'); 
        // Route::get('product_category','index')->name('product_category'); 
        Route::get('product_category/create','create')->name('product_category.create');
        Route::post('product_category/store','store')->name('product_category.store');
        Route::post('product_category/slug','createSlug')->name('product_category.slug');
        Route::post('product_category/destroy/{id}', 'destroy')->name('product_category.destroy');
        
        Route::get('product_category/detail/{id}', 'detail')->name('product_category.detail');
        
        Route::post('product_category/update/{id}', 'update')->name('product_category.update');
        Route::post('product_category/restore/{id}','restore')->name('product_category.restore');
        Route::post('product_category/force-delete/{id}','forceDelete')->name('product_category.force.delete');
    });
    
});



Route::prefix('admin')->middleware('check.is.admin')->name('admin.')->group(function(){
    Route::controller(ProductController::class)->group(function(){
        // Route::get('product','index')->name('product'); 
        Route::get('product/create','create')->name('product.create');
        Route::post('product/store','store')->name('product.store');
        Route::post('product/slug','createSlug')->name('product.slug');
        Route::post('product/destroy/{id}', 'destroy')->name('product.destroy');
        
        Route::get('product/detail/{id}', 'detail')->name('product.detail');
        
        Route::post('product/update/{id}', 'update')->name('product.update');
        Route::post('product/restore/{id}','restore')->name('product.restore');
        Route::post('product/force-delete/{id}','forceDelete')->name('product.force.delete');
         
        
    });
    // Route::resource('product', ProductController::class);

    Route::post('product-upload-image',[ProductController::class, 'uploadImage'])->name('product.image.upload');

    Route::post('product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('product/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('product.force.delete');
    Route::get('dashboardAdmin', [DashBoardAdminController::class, 'index'])->name('dashboard');
});

Route::get('/role-register',[DashboardController::class, 'registered'])->name('role.register')->middleware('check.is.admin');

Route::get('admin/form/shiftScheduling',[LeaveController::class, 'shiftScheduling'])->name('form.shiftScheduling')->middleware('check.is.admin');
Route::get('admin/form/shiftList',[LeaveController::class, 'shiftList'])->name('form.shiftList')->middleware('check.is.admin');

/******************************* */

Route::get('/admin', function () {
    return view('Admin.layout.master');
});
Route::get('/admin/createAcc/create', function () {
    return view('Admin.AccountOfStaff.create');
})->name('admin.createAcc')->middleware('check.is.admin');



Route::prefix('admin')->middleware('check.is.admin')->name('admin.')->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('createAcc/index','index')->name('index.accout');
        Route::get('createAcc/detail/{id}','detail')->name('create.detail');
        Route::post('createAcc/update/{id}','update')->name('create.update');
        Route::post('user/destroy/{id}','destroy')->name('user.destroy');
        Route::post('createAcc/store', 'store')->name('store');
    });   
});
Route::prefix('shifts')->middleware('check.is.admin')->name('shifts.')->group(function(){
    Route::controller(ScheduleController::class)->group(function(){
        // Route::get('index','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('store','store')->name('store');
        Route::post('destroy/{id}','destroy')->name('destroy');
        Route::post('update/{id}','update')->name('update');
        Route::post('schedule/restore/{id}','restore')->name('schedule.restore');
        Route::post('schedule/force-delete/{id}','forceDelete')->name('schedule.force.delete');
    });      
});
 

Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
Route::get('redirect-google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('call-back-google', [GoogleController::class, 'callback'])->name('google.call.back');

Route::get('user/profile/{id}', [ProductController::class, 'userProfile'])->name('user.profile')->middleware('check.is.admin');


/*****User */
Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(ProductCategoryController::class)->group(function(){
        Route::get('product_category','index')->name('product_category'); 
    });
    
});
Route::prefix('admin')->name('admin.')->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('product','index')->name('product'); 
    });
    Route::resource('product', ProductController::class);
});



Route::prefix('shifts')->name('shifts.')->group(function(){
    Route::controller(ScheduleController::class)->group(function(){
        Route::get('index','index')->name('index');
    });      
});


/****************************** */


Route::get('/feedback',[FeedbackController::class, 'showForm'])->name('feedback-form')  ;
Route::post('/feedback',[FeedbackController::class, 'submitFeedback'])->name('submit-feedback');
    