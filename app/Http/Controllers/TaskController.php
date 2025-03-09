<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(TaskRequest $request) {
        $task = $request->validated();
        $title = Task::create($task);
        return $title;
    }
    public function show()
    {
        $task = Task::all();
        return $task;
    }
    public function update(TaskRequest $request, $id){
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return $task;
    }
    public function destroy ($id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
