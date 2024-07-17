<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Models\Basis;
use App\Models\NumberIndex;
use App\Models\ObjectType;
use App\Models\Role;
use App\Models\Status;
use Inertia\Inertia;

class StatusController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Status', [
            'statuses' => Status::all(),
            'roles' => Role::all(),
            'basics' => Basis::all(),
            'number_indexes' => NumberIndex::all(),
            'object_types' => ObjectType::all(),
        ]);
    }
}
