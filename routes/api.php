<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EtudiantController;
use App\Http\Controllers\Api\FiliereController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('etudiants', EtudiantController::class);
    Route::apiResource('filieres', FiliereController::class);
});

Route::post("login",[UserController::class,'index']);


/*Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/etudiants', [EtudiantController::class, 'index']);
Route::post('/etudiants', [EtudiantController::class, 'store']);
Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show']);
Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update']);
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy']);
Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit']);
Route::post('/etudiants/create', [EtudiantController::class, 'create']);


Route::get('/filieres', [FiliereController::class, 'index']);
Route::post('/filieres', [FiliereController::class, 'store']);
Route::get('/filieres/{filiere}', [FiliereController::class, 'show']);
Route::put('/filieres/{filiere}', [FiliereController::class, 'update']);
Route::delete('/filieres/{filiere}', [FiliereController::class, 'destroy']);
Route::get('/filieres/{filiere}/edit', [FiliereController::class, 'edit']);

*/

