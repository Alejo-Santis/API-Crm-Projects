<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a list of tasks
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['client', 'user', 'project'])->get();
        if (!$tasks) {
            return response()->json('Tasks not found', 404);
        }
        return response()->json($tasks);
    }
    /**
     * Store a newly created task in storage
     * 
     * @param \App\Http\Requests\StoreTaskRequest
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task
        ]);
    }
    /**
     * Display the especified task
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with(['client', 'user', 'project'])->find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }
        return response()->json($task);
    }
    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\UpdateTaskRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }
        $task->update($request->validated());
        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    }
    /**
     * Remove the specified task from storage.
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json('Task not found', 404);
        }
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully'
        ], 204);
    }
}
