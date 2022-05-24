<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//custom admin routes
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
	Route::resource('products', '\App\Http\Controllers\ProductController');
	Route::resource('categories', '\App\Http\Controllers\CategoryController');
	Route::resource('orders', '\App\Http\Controllers\OrderController');
	Route::resource('transactions', '\App\Http\Controllers\TransactionController');
	Route::resource('users', '\App\Http\Controllers\UserController');
	Route::resource('customers', '\App\Http\Controllers\CustomerController');
	Route::resource('pricelists', '\App\Http\Controllers\PricelistController');
	Route::resource('advance-payments', '\App\Http\Controllers\AdvancePaymentController');

	//Show
	Route::get('/orders/{id}/show', [App\Http\Controllers\OrderController::class, 'show']);
	Route::get('/customers/{id}/show', [App\Http\Controllers\CustomerController::class, 'show']);

	
});


Route::get('/orders/exportcsv', [App\Http\Controllers\OrderController::class, 'exportcsv']);
Route::get('/transactions/exportcsv', [App\Http\Controllers\TransactionController::class, 'exportcsv']);
Route::get('/pricelists/exportcsv', [App\Http\Controllers\PricelistController::class, 'exportcsv']);
Route::get('/customers/exportcsv', [App\Http\Controllers\CustomerController::class, 'exportcsv']);

//Ajax
Route::post('/orders/additem', [App\Http\Controllers\OrderController::class, 'additem']);
Route::post('/orders/searchitem', [App\Http\Controllers\OrderController::class, 'searchitem']);
Route::post('/orders/add_discount', [App\Http\Controllers\OrderController::class, 'add_discount']);
Route::post('/orders/remove_item', [App\Http\Controllers\OrderController::class, 'remove_item']);
Route::post('/orders/update_item_qty', [App\Http\Controllers\OrderController::class, 'update_item_qty']);
Route::post('/orders/calculate_order', [App\Http\Controllers\OrderController::class, 'calculate_order']);
Route::post('/orders/get_product_category', [App\Http\Controllers\OrderController::class, 'get_product_category']);
Route::post('/orders/advance-payments', [App\Http\Controllers\AdvancePaymentController::class, 'advance_payments']);


/*
Make:
php artisan make:controller OrdersitemController --model=User
php artisan make:model AdvancePayment -mcr
php artisan make:seeder CustomersTableSeeder

Step 1:
php artisan key:generate
php artisan cache:clear //clear the view cache
php artisan config:clear //clear confige cache

Step 2:
php artisan migrate

Step 3:
php artisan db:seed --class=CustomersTableSeeder
php artisan db:seed --class=ProductsTableSeeder
php artisan db:seed --class=UsersTableSeeder



@csrf
@method('DELETE')
{{ csrf_field() }}

composer require laravelcollective/html

custom paginatation template
https://www.codecheef.org/article/laravel-7-custom-pagination-example-tutorial
{!! $customers->links() !!}



https://www.jhanley.com/laravel-redirecting-http-to-https/
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

php artisan make:middleware HttpRedirect
*/