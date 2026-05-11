<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contribution;
use App\Models\Student;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $contributions = Contribution::query()
            ->with(['campaign', 'student'])
            ->when($search, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('donor_name', 'like', "%{$search}%")
                        ->orWhere('donor_email', 'like', "%{$search}%")
                        ->orWhereHas('campaign', fn ($query) => $query->where('title', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('contributions.index', compact('contributions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campaigns = Campaign::orderBy('title')->get();
        $students = Student::orderBy('name')->get();
        $selectedCampaign = request('campaign_id');

        return view('contributions.create', compact('campaigns', 'students', 'selectedCampaign'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contribution = Contribution::create($this->validatedData($request));

        return redirect()
            ->route('campaigns.show', $contribution->campaign)
            ->with('success', 'Contribution enregistree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribution $contribution)
    {
        $contribution->load(['campaign.student', 'student']);

        return view('contributions.show', compact('contribution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contribution $contribution)
    {
        $campaigns = Campaign::orderBy('title')->get();
        $students = Student::orderBy('name')->get();

        return view('contributions.edit', compact('contribution', 'campaigns', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contribution $contribution)
    {
        $contribution->update($this->validatedData($request));

        return redirect()
            ->route('contributions.show', $contribution)
            ->with('success', 'Contribution mise a jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return redirect()
            ->route('contributions.index')
            ->with('success', 'Contribution supprimee avec succes.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'student_id' => ['nullable', 'exists:students,id'],
            'donor_name' => ['required', 'string', 'max:140'],
            'donor_email' => ['nullable', 'email', 'max:160'],
            'amount' => ['required', 'numeric', 'min:1', 'max:999999.99'],
            'message' => ['nullable', 'string', 'max:1000'],
            'anonymous' => ['nullable', 'boolean'],
            'paid_at' => ['nullable', 'date'],
        ]);

        $data['anonymous'] = $request->boolean('anonymous');

        return $data;
    }
}
