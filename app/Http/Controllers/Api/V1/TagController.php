<?php

namespace App\Http\Controllers\APi\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json(TagResource::collection($tags), 200);
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('modifyTags', Tag::class);
        $tag = new TagResource(Tag::create($request->all()));
        return response()->json([
            'message' => 'Tag created successfully',
            'tag' => $tag
        ], 201);
    }

    /**
     * Display the specified tag.
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return response()->json($tag, 200);
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $this->authorize('modifyTags',$tag);
        $tag->update($request->all());
        return response()->json([
            'message' => 'Tag updated successfully',
            'tag' =>new TagResource($tag)
        ], 200);
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $this->authorize('modifyTags', $tag);
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully'], 200);
    }
}