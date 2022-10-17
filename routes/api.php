<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\PosController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/supplier',SupplierController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/expense', ExpenseController::class);
Route::post('/salary/paid/{id}', [SalaryController::class,'paid']);
Route::get('/salary',[SalaryController::class,'allSalary']);
Route::get('/view/{id}',[SalaryController::class,'ViewSalary']);
Route::get('/edit/salary/{id}',[SalaryController::class,'editSalary']);
Route::post('/salary/update/{id}',[SalaryController::class,'updateSalary']);
Route::post('/stock/update/{id}',[ProductController::class,'updateStock']);
Route::post('/customer',[CustomerController::class,'store']);
 Route::get('/allcustomer',[CustomerController::class,'index']);
Route::delete('/deletecustomer/{id}',[CustomerController::class,'destroy']);
Route::get('/editcustomer/{id}',[CustomerController::class,'show']);
Route::post('/updatecustomer/{id}',[CustomerController::class,'update']);
 Route::get('/gettingproduct/{id}',[PosController::class,'index']);
 Route::get('/addToCart/{id}',[CarteController::class,'AddTocart']);
Route::get('/cartProduct/',[CarteController::class,'ProductCart']);




