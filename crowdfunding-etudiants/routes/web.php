<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\StudentController;
use App\Models\Campaign;
use App\Models\Contribution;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'studentsCount' => Student::count(),
        'campaignsCount' => Campaign::count(),
        'contributionsTotal' => Contribution::sum('amount'),
        'featuredCampaigns' => Campaign::with('student')->latest()->take(3)->get(),
    ]);
})->name('home');

Route::view('/a-propos', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::resource('students', StudentController::class);
Route::resource('campaigns', CampaignController::class);
Route::resource('contributions', ContributionController::class);
