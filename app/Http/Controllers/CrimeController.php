<?php

namespace App\Http\Controllers;

use App\Http\Requests\Crime\StoreRequest;
use App\Http\Requests\Crime\UpdateRequest;
use App\Models\Crime;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Crime', [
            'crimes' => Crime::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreRequest $request) {
        Crime::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Crime $crime)
    {
        $crime->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crime $crime)
    {
        $crime->delete();
        return redirect()->route('crime.index');
    }
}
