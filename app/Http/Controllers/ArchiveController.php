<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStat1 = Task::where('task_status_id', 1)->get();
        $taskStat2 = Task::where('task_status_id', 2)->get();
        $taskStat3 = Task::where('task_status_id', 3)->get();
        $taskStat4 = Task::where('task_status_id', 4)->get();

        $archiveTasks = Archive::whereNotNull('task_date')->get();

        return Inertia::render('Task/IndexArhive', [
            'roles' => Role::all(),
            'tasks' => $archiveTasks,
            'statuses' => Status::all(),
            'taskStat1' => $taskStat1,
            'taskStat2' => $taskStat2,
            'taskStat3' => $taskStat3,
            'taskStat4' => $taskStat4,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
