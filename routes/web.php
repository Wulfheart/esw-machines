<?php

use App\Http\Controllers\MachineController;
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

Route::get('/', [MachineController::class, 'showAll'])->name('home');

Route::prefix('machine/{machine}/')->name('machine.')->group(function() {
    Route::post('start', [MachineController::class, 'start'])->name('start');
    Route::post('done', [MachineController::class, 'finish'])->name('done');
    Route::post('empty', [MachineController::class, 'empty'])->name('empty');
});
