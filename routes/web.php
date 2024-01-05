<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\ReviewLeaderController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RequirementController;
use App\Http\Controllers\Auth\DocumentController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DocumentsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\ExcelController;

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

//Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
});

// Author's Route
Route::get('/author/dashboard', function () {
    return view('admin.author_dashboard');
})->middleware(['auth', 'verified'])->name('author/dashboard');
Route::get('/author/document', function () {
    return view('admin.author_document');
})->middleware(['auth', 'verified'])->name('document');
Route::get('/author/report', function () {
    return view('admin.author_report');
})->middleware(['auth', 'verified'])->name('report');

Route::get('/report/{document}', [AuthorController::class, 'showReportPage'])->name('report');

// Review Leader's Route
Route::get('/reviewleader/dashboard', function () {
    return view('admin.leader_dashboard');
})->middleware(['auth', 'verified'])->name('reviewleader/dashboard');
Route::get('/reviewleader/document', function () {
    return view('admin.leader_document');
})->middleware(['auth', 'verified'])->name('reviewleader/document');
Route::get('/reviewleader/report', function () {
    return view('admin.leader_report');
})->middleware(['auth', 'verified'])->name('reviewleader/report');

Route::get('/api/documents/{document}', function (Document $document) {
    return response()->json([
      'id' => $document->id,
      'docname' => $document->docname,
    ]);
  });

Route::get('/validate/{document}', [ReviewLeaderController::class, 'showValidatePage'])->name('validate');
  

// Reviewer's Route
Route::get('/reviewer/dashboard', function () {
    return view('admin.reviewer_dashboard');
})->middleware(['auth', 'verified'])->name('reviewer/dashboard');
Route::get('/reviewer/document', function () {
    return view('admin.reviewer_document');
})->middleware(['auth', 'verified'])->name('reviewer/document');
Route::get('/reviewer/report', function () {
    return view('admin.reviewer_report');
})->middleware(['auth', 'verified'])->name('reviewer/report');
Route::get('/review', function () {
    return view('admin.review');
})->middleware(['auth', 'verified'])->name('review');

Route::get('/review/{document}', [ReviewerController::class, 'showReviewPage'])->name('review');

Route::post('/feedback/store/{document}', [ReviewerController::class, 'storeFeedback']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/author/document', [DocumentController::class, 'storeDocument']);

Route::post('/author/import', function (Request $request) {
    Excel::import(new DocumentsImport($request), $request->file('req'));
    return redirect()->back();
});

Route::post('/reviewleader/storeReviewer/{document}', [ReviewerController::class, 'StoreReviewer']);

Route::post('/remove/{feedback}', [ReviewLeaderController::class, 'remove']);

Route::get('/export-pdf/{document}', [PdfController::class, 'exportPdfWithTable']);


Route::get('/export-excel/{document}', [ExcelController::class, 'export']);

Route::post('/validate-feedback/{document}', [ReviewLeaderController::class, 'validateFeedback']);


require __DIR__.'/auth.php';
