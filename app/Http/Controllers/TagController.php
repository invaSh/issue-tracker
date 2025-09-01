<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.list', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'color' => 'nullable',
        ], [
            'name.required' => 'The tag name cannot be empty!'
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }


    public function attachTag(Request $request, Issue $issue)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags,id',
        ], [
            'tag_id.required' => 'The tag cannot be empty!',
            'tag_id.exists' => 'The selected tag does not exist',
        ]);

        $tag = Tag::findOrFail($request->tag_id);

        if ($issue->tags()->where('tag_id', $tag->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Tag is already attached to this issue'
            ], 400);
        }

        $issue->tags()->attach($tag->id);

        return response()->json([
            'success' => true,
            'id' => $tag->id,
            'name' => $tag->name,
            'color' => $tag->color ?? '#374151',
        ]);
    }

    public function detachTag(Request $request, Issue $issue)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags,id'
        ]);

        $tagId = $request->tag_id;

        if (!$issue->tags()->where('tag_id', $tagId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Tag is not attached to this issue'
            ], 400);
        }

        $tag = Tag::find($tagId);

        $issue->tags()->detach($tagId);

        return response()->json([
            'success' => true,
            'message' => 'Tag detached successfully',
            'tag' => $tag
        ]);
    }

}
