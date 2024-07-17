<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employer\FrontUpdateRequest;
use App\Http\Requests\Employer\StoreRequest;
use App\Http\Requests\Employer\UpdateRequest;
use App\Models\Employer;
use Illuminate\Http\Request;
use Inertia\Inertia;


class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Employer', [
            'employers' => Employer::all(),
        ]);
    }

    public function frontIndex()
    {
        return Inertia::render('Employer/Index', [
            'employers' => Employer::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreRequest $request) {
        Employer::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Employer $employer)
    {
        $employer->update($request->validated());
    }
    /**
     * Update the specified resource in storage.
     */
    public function frontUpdate(FrontUpdateRequest $request, Employer $employer)
    {
        $employer->update($request->validated());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employer.index');
    }


}
