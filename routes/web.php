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
use App\Http\Controllers\ReptileController;
use App\Http\Controllers\ApiDataController;

Route::get('/reptile-store-directory', [ReptileController::class, 'reptileStoreDirectory']);
Route::get('/store-directory', [ApiDataController::class, 'getStoreDirectory']);

Route::get('/reptile-loan-stores-start-with', [ReptileController::class, 'reptileLoanStoresStartWith']);
Route::get('/loan-stores-start-with-{alphabet}', [ApiDataController::class, 'getLoanStoresStartWith']);

Route::get('/reptile-loan-stores-start-with/secondary', [ReptileController::class, 'reptileLoanStoresStartWithSecondary']);
Route::get('/loan-stores-start-with-{alphabet}/{groupId}', [ApiDataController::class, 'getLoanStoresStartWithSecondary']);

Route::get('/reptile-loan-stores-detail', [ReptileController::class, 'reptileLoanStoresDetail']);
Route::get('/store/{lowerTitle}', [ApiDataController::class, 'getLoanStoresDetail']);

Route::get('/reptile-loan-stores-brand-near-me', [ReptileController::class, 'reptileLoanStoresBrandNearMe']);
Route::get('/{brandAlias}near-me', [ApiDataController::class, 'getLoanStoresBrandNearMe']);

Route::get('/reptile-loan-stores-brand-near-me-found', [ReptileController::class, 'reptileLoanStoresBrandNearMeFound']);
Route::get('/{brandAlias}/{shortName}', [ApiDataController::class, 'getLoanStoresBrandNearMeFound']);

Route::get('/reptile-loan-stores-brand-near-me-found-position', [ReptileController::class, 'reptileLoanStoresBrandNearMeFoundPosition']);
Route::get('/{brandAlias}/{shortName}/{city}', [ApiDataController::class, 'getLoanStoresBrandNearMePosition']);

Route::get('/', function () {
    return view('welcome');
});
