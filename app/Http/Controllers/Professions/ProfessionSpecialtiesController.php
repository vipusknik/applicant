<?php

namespace App\Http\Controllers\Professions;

use Illuminate\Http\Request;
use App\{Speciality, Profession};
use App\Http\Controllers\Controller;

class ProfessionSpecialtiesController extends Controller
{
    public function create(Profession $profession)
    {
        $specialties = Speciality::orderBy('title')->get(['id', 'title', 'code']);

        return view('professions.specialties.create', compact('profession', 'specialties'));
    }

    public function store(Profession $profession, Request $request) 
    {
        $profession->specialities()->syncWithoutDetaching($request->specialties);

        return redirect()
            ->route('profession.show', $profession->id)
            ->with('message', 'Специальности привязаны к профессии.');
    }

    public function destroy(Profession $profession, Speciality $specialty) 
    {
        $profession->specialities()
            ->wherePivot('speciality_id', $specialty->id)
            ->detach();

        return redirect()
            ->route('profession.show', $profession->id)
            ->with('message', 'Специальность откреплена от профессии.');
    }
}