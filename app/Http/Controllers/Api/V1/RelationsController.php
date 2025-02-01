<?php

namespace App\Http\Controllers\APi\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TagResource;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;
use App\Exceptions\CustomException;


class RelationsController extends Controller
{
    /**
     * Get lessons associated with the user.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function userLessons($user_id)
    {
        $user = User::with('lessons')->findOrFail($user_id);

        // if (!$user) {
        //     throw new CustomException("User with ID {$user_id} not found");
        // }

        $lessons = $user->lessons->map(function ($lesson) {
            return [
                'Title' => $lesson->title,
                'Content' => $lesson->body,
            ];
        });

        return response()->json([
            'data' => $lessons,
        ], 200);
    }



    /**
     * Get tags associated with the lesson.
     *
     * @param  int  $lesson_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function lessonTags($lesson_id)
    {
        $lesson = Lesson::with('tags')->findOrFail($lesson_id);
        $tags = $lesson->tags->map(function ($tag) {
            return [
                'Tag' => $tag->name,
            ];
        });

        return Response::json([
            'data' => $tags,
        ], 200);
    }

    /**
     * Get lessons associated with the tag.
     *
     * @param  int  $tag_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tagLessons($tag_id)
    {
        $tag = Tag::with('lessons')->findOrFail($tag_id);
        $lessons = $tag->lessons->map(function ($lesson) {
            return [
                'Title' => $lesson->title,
                'Content' => $lesson->body,
            ];
        });

        return Response::json([
            'data' => $lessons,
        ], 200);
    }
}
