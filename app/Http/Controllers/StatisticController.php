<?php

namespace App\Http\Controllers;

use App\Http\Requests\Assignment\StoreRequest;
use App\Http\Requests\Assignment\UpdateRequest;
use App\Models\Assignment;
use App\Models\Basis;
use App\Models\Crime;
use App\Models\Employer;
use App\Models\NumberIndex;
use App\Models\ObjectType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class StatisticController extends BaseController
{
    public function index()
    {
        $isUserOu = auth()->user()->department->department == 'ООУ';

        $usersForSelect = new User();
        $formatedUsersForSelect = $usersForSelect->getAllUsersForSmallSelectFormat();

        $allAssignments = Assignment::with([
            'basis',
            'crimes',
            'objectType',
            'numberIndex',
            'employer',
            'user',
            'results',
        ])->get();

        //дешифрование:
        foreach ($allAssignments as $assignment) {
            $assignment['object'] = Crypt::decryptString($assignment['object']);
        };

        return Inertia::render('Statistics/Index', [
            'numberIndexes' => NumberIndex::all(),
            'assignments' => $allAssignments,
            'basics' => Basis::all(),
            'objectTypeIds' => ObjectType::all(),
            'crimeIds' => Crime::orderBy('name', 'asc')->get(),
            'employerIds' => Employer::orderBy('name', 'asc')->get(),
            'isUserOu' => $isUserOu,
            'usersForSelect' => $formatedUsersForSelect,

        ]);
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['object'] = Crypt::encryptString($data['object']); //шифрование

        $crimesArr = $this->crimeService->prepareCrimes($data['additional_crimes_ids'], $data['main_crime_id']);

        unset($data['additional_crimes_ids']);
        unset($data['main_crime_id']);

        $assignment = Assignment::create($data);

        $this->crimeService->attachCrimes($crimesArr, $assignment);
    }


    public function update(Assignment $assignment, UpdateRequest $request)
    {
        $data = $request->validated();

        $data['object'] = Crypt::encryptString($data['object']); //шифрование

        $crimesArr = $this->crimeService->prepareCrimes($data['additional_crimes_ids'], $data['main_crime_id']);

        $assignment->crimes()->detach(); // Удаляем текущие привязки

        unset($data['additional_crimes_ids']);
        unset($data['main_crime_id']);
        $assignment->update($data);

        $this->crimeService->attachCrimes($crimesArr, $assignment);
    }


    public function destroy(Assignment $assignment)
    {
        $assignment->crimes()->detach();
        $assignment->delete();
        return redirect()->route('statistic.index');
    }

}
