<?php

namespace App\Http\Controllers;

use App\Http\Requests\Taskuser\UpdateRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class TaskUserController extends Controller
{
    public function index()
    {
        $userIsManager = auth()->user()->isManager(); //является ли пользователь директором или замом

        $userDepartmentId = auth()->user()->department_id; //id подразделения польз-ля
        $usersDepartments = User::with('tasks')->where('department_id', $userDepartmentId)->get(); //ids пользователей всего отдела, в котором работает пользователь
        foreach ($usersDepartments as $tasks) {
            $tasksDivision[] = $tasks['tasks'];
        } //задачи подразделения
        $flattenedTasks = [];
        foreach ($tasksDivision as $tasks) {
            $flattenedTasks = array_merge($flattenedTasks, $tasks->toArray());
        } //задачи подразделения в одном массиве
        $flattenedTasks = collect($flattenedTasks);
        $flattenedTasksIds = $flattenedTasks->pluck('id'); //только id задач подразделения
        $tasksDiv = Task::whereIn('id', $flattenedTasksIds)->with('users')->get(); //задачи подразделения с пользователями

        $userName = auth()->user()->name;
        $userSurName = auth()->user()->surname;
        $tasksUser = auth()->user()->tasks;
        $taskStat1 = Task::where('task_status_id', 1)->get();
        $taskStat2 = Task::where('task_status_id', 2)->get();
        $taskStat3 = Task::where('task_status_id', 3)->get();
        $taskStat4 = Task::where('task_status_id', 4)->get();

        $usersDiv = User::where('department_id', $userDepartmentId)->get(); //все работники подразделения

        $divisionNameCol = Department::where('id', $userDepartmentId)->get(); //наименование подразделения (коллекция)
        $divisionName = $divisionNameCol->pluck('department')->implode(''); //наименование подразделения (строка)

        return Inertia::render('Task/IndexUser', [
            'tasksUser' => $tasksUser,
            'departments' => Department::all(),
            'positions' => Position::all(),
            'roles' => Role::all(),
            'statuses' => Status::all(),
            'taskStat1' => $taskStat1,
            'taskStat2' => $taskStat2,
            'taskStat3' => $taskStat3,
            'taskStat4' => $taskStat4,
            'userName' => $userName,
            'userSurName' => $userSurName,
            'userIsManager' => $userIsManager,
            'tasks' => $tasksDiv,
            'users' => $usersDiv,
            'divisionName' => $divisionName,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function show(Task $taskuser)
    {
        $users = $taskuser->users;
        $statuses = Status::all();
        $createDate = date('d.m.Y', strtotime($taskuser->created_at));
        $createTime = $taskuser->created_at->format('h:i:s');
        $updateDate = date('d.m.Y', strtotime($taskuser->updated_at));
        $updateTime = $taskuser->updated_at->format('h:i:s');

        return Inertia::render('Task/ShowUser', [
            'task' => $taskuser,
            'createDate' => $createDate,
            'createTime' => $createTime,
            'updateDate' => $updateDate,
            'updateTime' => $updateTime,
            'statuses' => $statuses,
            'users' => $users,
        ]);
    }

//    для комментариев:
    public function update(int $taskuser, UpdateRequest $request)
    {
        $item = $request->validated();
        $taskuser = Task::find($taskuser);
        $taskuser->update($item);
    }

}
