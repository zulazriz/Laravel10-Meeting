<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\MeetingRequest;
use App\Http\Controllers\MeetingRequestController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');

// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    // Fetch meeting request data
    $meetingRequests = MeetingRequest::all();

    // Pass the data to the view
    return view('dashboard', ['meetingRequests' => $meetingRequests]);
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Meeting route
Route::post('/meeting-request', [MeetingRequestController::class, 'store'])->name('meeting-request.store');
Route::get('/meeting-request/create', [MeetingRequestController::class, 'create'])->name('meeting-request.create');
Route::delete('meeting-requests/{meetingRequest}', [MeetingRequestController::class, 'destroy'])->name('meeting-request.destroy');

require __DIR__.'/auth.php';
