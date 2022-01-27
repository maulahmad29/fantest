<?php

use App\Http\Controllers\Api\Identity\AuthController;
use App\Http\Controllers\Api\TestlogikaController;
use App\Http\Controllers\Api\UseCase\ApprovalEpresenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UseCase\EpresenceController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/epresence/{id}', [EpresenceController::class, 'get']);
    Route::post('/epresence', [EpresenceController::class, 'post']);

    Route::post('/approval-epresence', [ApprovalEpresenceController::class, 'approve']);
});

///////////////////
//////Soal Logika//
///////////////////

Route::post('/soal-satu', [TestlogikaController::class, 'soalSatu']);
Route::post('/soal-dua', [TestlogikaController::class, 'soalDua']);

