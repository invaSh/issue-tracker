<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Issue::with(['tags','comments'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->tag) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        $issues = $query->get();
        $tags = Tag::all();

        return view('issues.list', compact('issues', 'tags'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('issues.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'project_id' => 'required|exists:projects,id',
        ], [
            'title.required' => 'Project title cannot be empty!',
            'description.required' => 'Description cannot be empty!',
            'status.required' => 'status cannot be empty!',
            'due_date.required' => 'Due Date date cannot be empty!',
            'project_id.required' => 'Project cannot be empty!',
        ]);

        Issue::create($validated);

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully.');
    }

    public function show(Issue $issue)
    {
        $issue->load([
            'tags',
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc'); 
            },
            'project'
        ]);

        $allTags = Tag::all();

        return view('issues.show', compact('issue', 'allTags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $projects = Project::all();
        return view('issues.edit', compact('issue', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'project_id' => 'required|exists:projects,id',
        ], [
            'title.required' => 'Project title cannot be empty!',
            'description.required' => 'Description cannot be empty!',
            'status.required' => 'status cannot be empty!',
            'due_date.required' => 'Due Date date cannot be empty!',
            'project_id.required' => 'Project cannot be empty!',
        ]);

        $issue->update($validated);

        return redirect()->route('issues.show', $issue->id)
            ->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $issue->tags()->detach();
        $issue->delete();
        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully.');
    }
}
