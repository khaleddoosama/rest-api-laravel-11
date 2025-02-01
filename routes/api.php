<?php

use App\Http\Controllers\APi\V1\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APi\V1\UserController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\APi\V1\RelationsController;
use App\Http\Controllers\APi\V1\TagController;
use App\Http\Controllers\EmailController;


// Route::post('/send-reminder-email', [EmailController::class, 'sendReminderEmail'])->name('user.mail');
// Protected routes
Route::group(['prefix' => '/v1'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::apiResource('/user', UserController::class); 

    Route::middleware('auth:sanctum')->group(function () {
        // Protect all UserController routes except 'store'
        Route::apiResource('lessons', LessonController::class);
        Route::apiResource('tags', TagController::class);

        // RelationsController routes
        Route::get('users/{user_id}/lessons', [RelationsController::class, 'userLessons'])->name('user.lesson');
        Route::get('lessons/{lesson_id}/tags', [RelationsController::class, 'lessonTags'])->name('lesson.tags');
        Route::get('tags/{tag_id}/lessons', [RelationsController::class, 'tagLessons'])->name('tag.lessons');
    });
});