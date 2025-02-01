<?php

use App\Http\Controllers\APi\V1\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APi\V1\UserController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\APi\V1\RelationsController;
use App\Http\Controllers\APi\V1\TagController;
use App\Http\Controllers\EmailController;

Route::apiResource('/v1/user', UserController::class);

// Route::post('/send-reminder-email', [EmailController::class, 'sendReminderEmail'])->name('user.mail');
// Protected routes
Route::group(['prefix'=>'/v1'],function(){
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/users', function (Request $request) {
            return $request->user();
        });
  
        Route::any('lesson', function () {
            
    
            return Response::json([
               'data' => "Please make sure to update your code to use the newer version of our API.
            You should use lessons instead of lesson",
              
            ], 404);
        })->where('any', '.*');
        
    
        // Protect all UserController routes except 'store'
        Route::apiResource('lessons', LessonController::class);
        Route::apiResource('tags', TagController::class);
    
        // RelationsController routes
        Route::get('users/{id}/lessons', [RelationsController::class, 'userLessons'])->name('user.lesson');
        Route::get('lessons/{id}/tags', [RelationsController::class, 'lessonTags'])->name('lesson.tags');
        Route::get('tags/{id}/lessons', [RelationsController::class, 'tagLessons'])->name('tag.lessons');
    });
});


// Public route for login
Route::post('/login', [LoginController::class, 'login']);