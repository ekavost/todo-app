<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\createRequest;

class TaskController extends Controller
{
    public function create(CreateTaskRequest $request) {
        $data = $request->validated();
        $title = Task::create($data);
        return $title;
    }
    public function show()
    {
        $data = Task::all();
        return $data;
    }
    public function edit(){

    }
    public function delete()
    {

    }
}
