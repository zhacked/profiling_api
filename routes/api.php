<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    // Job
    Route::apiResources(['jobs'         => App\Http\Controllers\JobController::class]);

    // Job Types
    Route::apiResources(['job-types'    => App\Http\Controllers\JobTypeController::class]);

    // Job Levels
    Route::apiResources(['job-levels'   => App\Http\Controllers\JobLevelController::class]);

    // Educations
    Route::apiResources(['educations'   => App\Http\Controllers\EducationController::class]);

    // Departments
    Route::apiResources(['departments'  => App\Http\Controllers\DepartmentController::class]);

    // Skills
    Route::apiResources(['skills'       => App\Http\Controllers\SkillController::class]);

    // Achievements
    Route::apiResources(['achievements' => App\Http\Controllers\AchievementController::class]);

    // Credentials
    Route::apiResources(['credentials'  => App\Http\Controllers\CredentialController::class]);

    // Trainings
    Route::apiResources(['trainings' => App\Http\Controllers\TrainingController::class]);

    // Projects
    Route::apiResources(['projects'     => App\Http\Controllers\ProjectController::class]);

    // Locations
    Route::apiResources(['locations' => App\Http\Controllers\LocationController::class]);

    // Affiliations
    Route::apiResources(['affiliations' => App\Http\Controllers\AffiliationController::class]);

    // Industries
    Route::apiResources(['industries'   => App\Http\Controllers\IndustryController::class]);

    // Roles
    Route::apiResources(['roles' => \App\Http\Controllers\RolesController::class]);

    // Users
    Route::apiResources(['users' => \App\Http\Controllers\UserController::class]);

    // Languages
    Route::apiResources(['languages' => \App\Http\Controllers\LanguageController::class]);

     // applications
     Route::apiResources(['applications' => \App\Http\Controllers\ApplicationController::class]);

      // educationalbackground
    Route::apiResources(['educational-backgrounds' => \App\Http\Controllers\EducationalBackgroundController::class]);

     // ProficiencyLevel
     Route::apiResources(['proficiency-levels' => \App\Http\Controllers\ProficiencyLevelController::class]);

      // Schedulers
    Route::apiResources(['schedulers' => \App\Http\Controllers\SchedulerController::class]);

        // Banners
    Route::apiResources(['banners' => \App\Http\Controllers\BannerController::class]);

    
});

// Authentication routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile']);
});
