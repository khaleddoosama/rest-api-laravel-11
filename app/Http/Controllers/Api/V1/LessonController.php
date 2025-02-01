<?php

namespace App\Http\Controllers\APi\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;
        $lessons = LessonResource::collection(Lesson::paginate($limit));
        return $lessons->response()->setStatusCode(200, "Lessons Retrieved Successfully");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $authUser = Auth::user();
            $lessonData = array_merge($request->all(), ['user_id' => $authUser->id]);
            $lesson = Lesson::create($lessonData);
            if ($request->has('tags')) 
            {
                $lesson->tags()->attach($request->input('tags'));
            }
            $lessonResource = new LessonResource($lesson);
            return $lessonResource->response()->setStatusCode(201, 'Lesson Created Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return (new LessonResource($lesson))->response()->setStatusCode(200, "Lesson Retrieved Successfully");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->authorize('update', $lesson);
        $lesson->update($request->all());
        $lessonResource = new LessonResource($lesson);
        return $lessonResource->response()->setStatusCode(200, 'Lesson Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $lesson = Lesson::findOrFail($id);
        $this->authorize('delete', $lesson);
        $lesson->delete();
        return response()->json(['message' => 'Lesson Deleted Successfully'], 200);
    }
}