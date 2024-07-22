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
        $archiveTasks = Archive::whereNotNull('task_date')->get();

        return Inertia::render('Task/IndexArhive', [
            'roles' => Role::all(),
            'tasks' => $archiveTasks,
            'statuses' => Status::all(),
        ]);
    }
}
