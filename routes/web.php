<?php

use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/init-call', 'call');
Route::post('/call', [VoiceController::class, 'initiateCall'])->name('initiate_call');

Route::webhooks('receiving-url-for-twilio-app-1', 'webhook-sending-twilio-app-1');