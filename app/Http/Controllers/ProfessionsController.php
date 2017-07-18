<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Profession\{
    Profession,
    ProfessionCategories
};

class ProfessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProfessionCategories $category)
    {
        $professions = Profession::of($category)
            ->orderBy('title')
            ->with(['category'])
            ->paginate(15);

        return view('professions.index', compact('professions', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(Profession $profession)
    {
        return view('professions.show', compact('profession'));
    }

    public function search(Request $request)
    {
        $q = Profession::query();

        if (request()->has('query')) {
            $q->like(request('query'));
        }

        if (request()->has('direction')) {
            $q->ofDirection(request('direction'));
        }

        $professions = $q->orderBy('title')->paginate(15);
        $profDirections = ProfDirection::all()->sortBy('title');

        $request->flashOnly(['query', 'direction']);

        return view('professions.index', compact('professions', 'profDirections'));
    }
}
