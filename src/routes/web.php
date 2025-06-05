<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ContactFormController;

// Route::get('/', [ContactController::class, 'index']);
// Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
// Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/', [ContactFormController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactFormController::class, 'confirm'])->name('contact.confirm');
Route::post('/store', [ContactFormController::class, 'store'])->name('contact.store');
Route::get('/thanks', [ContactFormController::class, 'complete'])->name('contact.complete');
Route::get('/admin', [ContactController::class, 'index'])->name('admin.contacts.index');
Route::get('/admin/contacts/{contact}', [ContactController::class, 'show'])->name('admin.contacts.show');
Route::delete('/admin/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
Route::get('/admin/contacts/export-csv', [ContactController::class, 'exportCsv'])->name('admin.contacts.exportCsv');
Route::get('/', function () {
    return view('welcome');
});