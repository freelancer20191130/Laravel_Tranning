<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\M0010Controller;
use App\Http\Controllers\M0020Controller;
use App\Http\Controllers\M0030Controller;
use App\Http\Controllers\M0040Controller;
use App\Http\Controllers\M0050Controller;
use App\Http\Controllers\M0060Controller;
use App\Http\Controllers\M0070Controller;
use App\Http\Controllers\M0080Controller;
use App\Http\Controllers\Q0070Controller;
use App\Http\Controllers\sS0020Controller;
use App\Http\Controllers\sS0030Controller;
use App\Http\Controllers\sM0100Controller;

use App\Http\Controllers\PopupController;
use GuzzleHttp\Middleware;
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
//login
Route::get('/',[LoginController::class,'getIndex'])->name('login');
Route::post('/postLogin',[LoginController::class,'postLogin']);
//logout
Route::get('/logout', [LoginController::class,'getLogout']);
//error
Route::get('/error', function(){
    return view("layouts.error");
});
//middleware
Route::middleware(['AuthLogined','web'])->group(function (){
    Route::get('/menu',[MenuController::class,'getIndex']);
    
    //manhnd--start
    Route::get('/m0010',[M0010Controller::class,'getIndex']);
    Route::post('/m0010/refer',[M0010Controller::class,'getDataByCode']);
    Route::post('/m0010/add',[M0010Controller::class,'addNewData']);
    Route::post('/m0010/edit',[M0010Controller::class,'editData']);
    Route::post('/m0010/delete',[M0010Controller::class,'deleteData']);
    Route::post('/m0010/search',[M0010Controller::class,'searchData']);
    Route::post('/popup/employee', [PopupController::class, 'getEmployeePopup']);
    Route::post('/popup/refer-organization', [PopupController::class, 'referOrganizationCombobox']);
    Route::post('/popup/refer-cbx', [PopupController::class, 'referCombobox']);
    Route::post('/popup/refer-table', [PopupController::class, 'referDataTable']);
    //manhnd--end

    Route::get('/m0020',[M0020Controller::class,'getIndex']);
    Route::get('/m0020/getData',[M0020Controller::class,'getData']);
    Route::post('/m0020/popup',[M0020Controller::class,'getDataPopup']);
    Route::post('/m0020/saveOrganization',[M0020Controller::class,'saveOrganization']);
    Route::post('/m0020/referData',[M0020Controller::class,'referData']);
    Route::post('/m0020/search',[M0020Controller::class,'postSearch']);
    Route::post('/m0020/save',[M0020Controller::class,'saveData']);
    Route::post('/m0020/delete',[M0020Controller::class,'deleteData']);
    Route::get('/m0030',[M0030Controller::class,'getIndex']);
    Route::post('/m0030/search',[M0030Controller::class,'postSearch']);
    Route::post('/m0030/save',[M0030Controller::class,'saveData']);
    Route::post('/m0030/delete',[M0030Controller::class,'deleteData']);

    //manhnd--start
    Route::get('/m0040',[M0040Controller::class,'getIndex']);
    Route::post('/m0040/search',[M0040Controller::class,'getLeftData']);
    Route::post('/m0040/refer',[M0040Controller::class,'getDataByCode']);
    Route::post('/m0040/add',[M0040Controller::class,'addNewData']);
    Route::post('/m0040/edit',[M0040Controller::class,'editData']);
    Route::post('/m0040/delete',[M0040Controller::class,'deleteData']);
    //manhnd--end

    Route::get('/m0050',[M0050Controller::class,'getIndex']);
    Route::post('/m0050/save',[M0050Controller::class,'saveData']);

    //manhnd--start
    Route::get('/m0060',[M0060Controller::class,'getIndex']);
    Route::post('/m0060/search',[M0060Controller::class,'getLeftData']);
    Route::post('/m0060/refer',[M0060Controller::class,'getDataByCode']);
    Route::post('/m0060/add',[M0060Controller::class,'addNewData']);
    Route::post('/m0060/edit',[M0060Controller::class,'editData']);
    Route::post('/m0060/delete',[M0060Controller::class,'deleteData']);
    //manhnd--end

    Route::get('/m0070',[M0070Controller::class,'getIndex']);

    //manhnd--start
    Route::get('/m0080',[M0080Controller::class,'getIndex']);
    Route::post('/m0080/search',[M0080Controller::class,'getLeftData']);
    Route::post('/m0080/refer',[M0080Controller::class,'getRightData']);
    Route::post('/m0080/add',[M0080Controller::class,'addNewData']);
    Route::post('/m0080/edit',[M0080Controller::class,'editData']);
    Route::post('/m0080/delete',[M0080Controller::class,'deleteData']);
    //manhnd--end

    Route::get('/q0070',[Q0070Controller::class,'getIndex']);
    Route::get('/sm0100',[sM0100Controller::class,'getIndex']);
    Route::post('/saveData',[sM0100Controller::class,'saveData']);

    Route::get('/ss0020',[sS0020Controller::class,'getIndex']);
    Route::post('/ss0020/search',[sS0020Controller::class,'postSearch']);
    Route::post('/ss0020/save',[sS0020Controller::class,'saveData']);
    Route::get('/ss0020/refer',[sS0020Controller::class,'referData']);
    Route::post('/ss0020/delete',[sS0020Controller::class,'deleteData']);
    
    //manhnd--start
    Route::get('/ss0030',[sS0030Controller::class,'getIndex']);
    Route::post('/ss0030/search',[sS0030Controller::class,'searchData']);
    Route::post('/ss0030/edit',[sS0030Controller::class,'editData']);
    //manhnd--end
    Route::post('/popup/password', [PopupController::class, 'getEmployeePassword']);     
});