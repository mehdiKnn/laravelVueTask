<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Task $article
     * @return void
     */
    public function index(Task $task)
    {
        return $task->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     *
     *
     * @param TaskRequest $request
     * @return Task
     */
    public function store(TaskRequest $request)
    {
        return Task::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskRequest $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        try {
            Task::findOrFail($id)->update($request->all());
            return ['status' => '200',
                'message' => 'Update with success'
            ];
        } catch (\Exception $error) {
            return ['status' => '404',
                'message' => 'Error while updating'
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id)->delete();
            return ['status' => '200',
                'message' => 'Deleting with success'
            ];;
        } catch (ModelNotFoundException $ex) {
            return ['status' => '404',
                'message' => 'Error while deleting'
            ];
        }
    }
}
