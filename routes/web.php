<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LetterpadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('welcome', function () {
//     return view('welcome');
// });

Route::get('welcome', [LoginController::class, 'welcome'])->name('welcome');

Route::get('/', [LoginController::class, 'index'])->name('login.index');



Route::get('/register/index', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

Route::post('/login/check', [LoginController::class, 'check'])->name('login.check');


//Auth Check
Route::group(['middleware' => ['auth']], function () { 

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');


Route::resource('ticket',TicketController::class); 
Route::post('/ticket/ajaxTable',[TicketController::class,'ajaxTable'])->name('ticket.ajaxTable'); 
Route::post('/ticket/delete',[TicketController::class,'destroy'])->name('ticket.delete');  

Route::resource('agreement',AgreementController::class); 
Route::post('/agreement/ajaxTable',[AgreementController::class,'ajaxTable'])->name('agreement.ajaxTable');

//For Admin Login Only
    Route::group(['middleware'=>'is_admin'],function(){

    //User
    Route::resource('user',UserController::class); 
    Route::post('/user/ajaxTable',[UserController::class,'ajaxTable'])->name('user.ajaxTable'); 
    Route::post('/user/delete',[UserController::class,'destroy'])->name('user.delete'); 

    //Contact Us
    Route::resource('contact',ContactController::class); 
    Route::post('/contact/ajaxTable',[ContactController::class,'ajaxTable'])->name('contact.ajaxTable'); 
    Route::post('/contact/delete',[ContactController::class,'destroy'])->name('contact.delete'); 

    //lead and Category

    Route::resource('category',CategoryController::class);   
    Route::post('/category/ajaxTable',[CategoryController::class,'ajaxTable'])->name('category.ajaxTable'); 
    Route::post('/category/delete',[CategoryController::class,'destroy'])->name('category.delete');


    Route::resource('lead',LeadController::class);  
    Route::post('/lead/ajaxTable',[LeadController::class,'ajaxTable'])->name('lead.ajaxTable'); 
    Route::post('/lead/delete',[LeadController::class,'destroy'])->name('lead.delete'); 



    });


    Route::resource('bill',BillController::class);  
    Route::post('/bill',[BillController::class,'ajaxTable'])->name('bill.ajaxTable'); 
    Route::post('/bill/delete',[BillController::class,'destroy'])->name('bill.delete'); 
    Route::post('/bill/get_data/{id}',[BillController::class,'get_data'])->name('bill.get_data'); 
    Route::get('/bill/show_bill/{id}',[BillController::class,'show_bill'])->name('bill.show_bill'); 


    Route::resource('service',ServiceController::class);  
    Route::post('/service',[ServiceController::class,'ajaxTable'])->name('service.ajaxTable'); 
    Route::post('/service/store',[ServiceController::class,'store'])->name('service.store'); 
    Route::post('/service/delete',[ServiceController::class,'destroy'])->name('service.delete'); 

    Route::resource('portfolio',PortfolioController::class);  
    Route::post('/portfolio',[PortfolioController::class,'ajaxTable'])->name('portfolio.ajaxTable'); 
    Route::post('/portfolio/store',[PortfolioController::class,'store'])->name('portfolio.store');
    Route::post('/portfolio/delete',[PortfolioController::class,'destroy'])->name('portfolio.delete'); 


    Route::resource('blog',BlogController::class);  
    Route::post('/blog',[BlogController::class,'ajaxTable'])->name('blog.ajaxTable'); 
    Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
    Route::post('/blog/delete',[BlogController::class,'destroy'])->name('blog.delete');
    
    Route::resource('product_category',ProductCategoryController::class);  
    Route::post('/product_category',[ProductCategoryController::class,'ajaxTable'])->name('product_category.ajaxTable'); 
    Route::post('/product_category/store',[ProductCategoryController::class,'store'])->name('product_category.store');
    Route::post('/product_category/delete',[ProductCategoryController::class,'destroy'])->name('product_category.delete'); 



    Route::resource('product',ProductController::class);  
    Route::post('/product',[ProductController::class,'ajaxTable'])->name('product.ajaxTable'); 
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    Route::post('/product/delete',[ProductController::class,'destroy'])->name('product.delete'); 
    Route::post('/product_renewal',[ProductController::class,'search'])->name('product_renewal.search');
    Route::post('/product_renewal_edit',[ProductController::class,'edit_search'])->name('product_renewal_edit.edit_search');



    Route::resource('letterpad',LetterpadController::class);  
    Route::post('/letterpad',[LetterpadController::class,'ajaxTable'])->name('letterpad.ajaxTable');
    Route::post('/letterpad/store',[LetterpadController::class,'store'])->name('letterpad.store');
    Route::post('/letterpad/delete',[LetterpadController::class,'destroy'])->name('letterpad.delete'); 


});
