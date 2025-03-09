<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\createRequest;

class TaskController extends Controller
{
    public function create(CreateTaskRequest $request) {
        $task = $request->validated();
        $title = Task::create($task);
        return $title;
    }
    public function show()
    {
        $task = Task::all();
        return $task;
    }
    public function update(UpdateTaskRequest $request, $id){
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }
    public function delete()
    {

    }
}
