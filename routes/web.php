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

Route::get('/', function () {
    return redirect('/all');
});

Auth::routes();

Route::get('/all', [App\Http\Controllers\LabelController::class, 'index']);

Route::post('/addLabel', [App\Http\Controllers\LabelController::class, 'addLabel']);

Route::get('/userLabels', [App\Http\Controllers\LabelController::class, 'findUserLabels']);
Route::get('/companyLabels', [App\Http\Controllers\LabelController::class, 'findCompanyLabels']);
Route::get('/siteLabels', [App\Http\Controllers\LabelController::class, 'findSiteLabels']);
