<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ConversionsController;

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

Route::group(array('prefix' => 'api'), function()
{

  Route::get('/', function () {
      return response()->json(['message' => 'API funcionando', 'status' => 'Connected']);;
  });

  Route::resource('schools', SchoolsController::class);
  Route::resource('courses', CoursesController::class);
  Route::resource('conversions', ConversionsController::class);
});

Route::get('/', function () {
    return redirect('api');
});