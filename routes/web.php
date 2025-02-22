<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/meeting', [IndexController::class, 'meeting'])->name('meeting');
Route::get('/get-data', [ApiController::class, 'getData'])->name('getData');


Route::get('/cities/{id}', [IndexController::class, 'getCities'])->name('cities');
Route::get('/fields-of-study/{fieldOfStudyId}', [IndexController::class, 'getFieldOfStudy'])->name('fields-of-study');
Route::get('/departments/{departmentId}', [IndexController::class, 'getDepartments'])->name('departments');
Route::get('/institutions/{institutionId}', [IndexController::class, 'getInstitutions'])->name('institutions');
Route::get('/languages/{languageId}', [IndexController::class, 'getLanguages'])->name('');
Route::get('/modes-of-study/{modeId}', [IndexController::class, 'getModeOfStudy'])->name('languagesmodes-of-study');
Route::get('/locations/{locationId}', [IndexController::class, 'getLocations'])->name('locations');
Route::get('/types-of-institutions/{typeId}', [IndexController::class, 'getTypeOfInstitutions'])->name('types-of-institutions');
Route::get('/language-levels/{levelId}', [IndexController::class, 'getProgrammesByLanguageLevel'])->name('language-levels');
Route::get('/gpa/{minGpa}', [IndexController::class, 'getProgrammesByGpa'])->name('gpa');
Route::get('/programmes', [IndexController::class, 'getAllProgrammes'])->name('all-programmes');


Route::get('/field-of-study', [IndexController::class, 'fieldOfStudy'])->name('cities');
Route::get('/cities', [IndexController::class, 'getCities'])->name('cities');
Route::get('/cities', [IndexController::class, 'getCities'])->name('cities');
Route::get('/cities', [IndexController::class, 'getCities'])->name('cities');
Route::get('/cities', [IndexController::class, 'getCities'])->name('cities');
Route::get('/cities', [IndexController::class, 'getCities'])->name('cities');
