<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;

use App\Http\Requests\User\UpdateRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $positions = Position::all();
        $roles = Role::all();

        return Inertia::render('Admin/User/Index', [
            'users' => User::all(),
            'departments' => $departments,
            'positions' => $positions,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $roles = Role::all();

        return Inertia::render('Admin/User/Create', [
            'departments' => $departments,
            'positions' => $positions,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = new User;
        $user->fill($request->validated());
        $user->password = Hash::make($request->password);
        $user->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $birthday = date('d.m.Y', strtotime($user->birthday));
        $department = $user->department->department;
        $position = $user->position;
        $role = $user->role->role;
        $createDate = date('d.m.Y', strtotime($user->created_at));
        $createTime = $user->created_at->format('h:i:s');
        $updateDate = date('d.m.Y', strtotime($user->updated_at));
        $updateTime = $user->updated_at->format('h:i:s');

        return Inertia::render('Admin/User/Show', [
            'user' => $user,
            'birthday' => $birthday,
            'department' => $department,
            'position' => $position,
            'role' => $role,
            'createDate' => $createDate,
            'createTime' => $createTime,
            'updateDate' => $updateDate,
            'updateTime' => $updateTime,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        $positions = Position::all();
        $roles = Role::all();

        return Inertia::render('Admin/User/Edit', [
            'departments' => $departments,
            'positions' => $positions,
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdateRequest $request)
    {
        $data = $request->validated();
        if (isset($data['password'])) {
            //сохраняем с паролем
            $user->fill($data);
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            //сохраняем без пароля
            $user->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $tasks = $user['tasks'];
        unset($user['tasks']);
        $user->tasks()->detach($tasks);
        $user->delete();
        return redirect()->route('user.index');
    }
}
