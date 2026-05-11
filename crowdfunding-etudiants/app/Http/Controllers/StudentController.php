<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $students = Student::query()
            ->withCount('campaigns')
            ->when($search, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('major', 'like', "%{$search}%")
                        ->orWhere('university', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('students.index', compact('students', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::create($this->validatedData($request));

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Etudiant ajoute avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['campaigns.contributions', 'contributions.campaign']);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student->update($this->validatedData($request, $student));

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Profil etudiant mis a jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Etudiant supprime avec succes.');
    }

    private function validatedData(Request $request, ?Student $student = null): array
    {
        $studentId = $student?->id ?? 'NULL';

        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:students,email,'.$studentId],
            'university' => ['required', 'string', 'max:160'],
            'major' => ['required', 'string', 'max:160'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
