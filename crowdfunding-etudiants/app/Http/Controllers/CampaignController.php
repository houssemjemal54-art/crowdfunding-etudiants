<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Student;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $status = request('status');

        $campaigns = Campaign::query()
            ->with('student')
            ->withSum('contributions', 'amount')
            ->when($search, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhereHas('student', fn ($query) => $query->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($status, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('campaigns.index', compact('campaigns', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();

        return view('campaigns.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campaign = Campaign::create($this->validatedData($request));

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('success', 'Campagne creee avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $campaign->load(['student', 'contributions.student']);
        $students = Student::orderBy('name')->get();

        return view('campaigns.show', compact('campaign', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $students = Student::orderBy('name')->get();

        return view('campaigns.edit', compact('campaign', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $campaign->update($this->validatedData($request));

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('success', 'Campagne mise a jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campagne supprimee avec succes.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'min:30'],
            'goal_amount' => ['required', 'numeric', 'min:50', 'max:999999.99'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'in:draft,active,funded,closed'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ]);
    }
}
