<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with(['client', 'user'])->get();
        if (!$projects) {
            return response()->json('Projects not found', 404);
        }
        return response()->json($projects);
    }
    /**
     * Store a newly created project in th storage
     * 
     * @param  \App\Http\Requests\StoreProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project
        ]);
    }
    /**
     * Display the specified project
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with(['client', 'user'])->find($id);
        if (!$project) {
            return response()->json('Project not found', 404);
        }
        return response()->json($project);
    }
    /**
     * @param  \App\Http\Requests\UpdateProjectRequest $request
     * @param $id
     * @return \Iluminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json('Project not found', 404);
        }
        $project->update($request->validated());
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }
    /**
     * Remove the specified project from storage
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json('Project not found', 404);
        }
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully'
        ], 204);
    }
}
