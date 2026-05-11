@csrf

<div class="form-grid">
    <div class="field">
        <label for="campaign_id">Campagne</label>
        <select class="form-control" id="campaign_id" name="campaign_id" required>
            <option value="">Choisir une campagne</option>
            @foreach ($campaigns as $campaign)
                <option value="{{ $campaign->id }}" @selected(old('campaign_id', $contribution->campaign_id ?? $selectedCampaign ?? '') == $campaign->id)>{{ $campaign->title }}</option>
            @endforeach
        </select>
        @error('campaign_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="student_id">Etudiant contributeur</label>
        <select class="form-control" id="student_id" name="student_id">
            <option value="">Contribution externe</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $contribution->student_id ?? '') == $student->id)>{{ $student->name }}</option>
            @endforeach
        </select>
        @error('student_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="donor_name">Nom donateur</label>
        <input class="form-control" id="donor_name" name="donor_name" value="{{ old('donor_name', $contribution->donor_name ?? '') }}" required>
        @error('donor_name') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="donor_email">Email donateur</label>
        <input class="form-control" id="donor_email" type="email" name="donor_email" value="{{ old('donor_email', $contribution->donor_email ?? '') }}">
        @error('donor_email') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="amount">Montant (DT)</label>
        <input class="form-control" id="amount" type="number" step="0.01" min="1" name="amount" value="{{ old('amount', $contribution->amount ?? '') }}" required>
        @error('amount') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="paid_at">Date paiement</label>
        <input class="form-control" id="paid_at" type="date" name="paid_at" value="{{ old('paid_at', isset($contribution) && $contribution->paid_at ? $contribution->paid_at->format('Y-m-d') : now()->format('Y-m-d')) }}">
        @error('paid_at') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field full">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4">{{ old('message', $contribution->message ?? '') }}</textarea>
        @error('message') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field full">
        <label>
            <input type="checkbox" name="anonymous" value="1" @checked(old('anonymous', $contribution->anonymous ?? false))>
            Afficher comme anonyme
        </label>
        @error('anonymous') <div class="error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="actions">
    <x-button type="submit">{{ $submitLabel }}</x-button>
    <x-button :href="route('contributions.index')" variant="secondary">Retour</x-button>
</div>
