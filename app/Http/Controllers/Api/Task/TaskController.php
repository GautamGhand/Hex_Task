<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\TaskStoreRequest;
use App\Http\Requests\Api\Task\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::get();
        return Response::json([
            'success' => true,
            'message' => 'All Tasks Fetched Successfully',
            'tasks' => $tasks
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->all());
        return Response::json([
            'success' => true,
            'message' => 'Task Created Successfully',
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();
        if(!$task){
            return Response::json([
                'success' => true,
                'message' => 'Task Not Found',
            ],401);
        }
        return Response::json([
            'success' => true,
            'message' => 'Task Fetched Successfully',
            'task' => $task
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        $task = Task::where('id', $id)->first();
        if(!$task){
            return Response::json([
                'success' => true,
                'message' => 'Task Not Found',
            ],401);
        }
        $task->update($request->all());
        return Response::json([
            'success' => true,
            'message' => 'Task Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->first();
        if(!$task){
            return Response::json([
                'success' => true,
                'message' => 'Task Not Found',
            ],401);
        }
        $task->delete();
        return Response::json([
            'success' => true,
            'message' => 'Task Deleted Successfully',
        ]);
    }
}
