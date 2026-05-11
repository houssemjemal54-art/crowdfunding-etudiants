@csrf

<div class="form-grid">
    <div class="field">
        <label for="student_id">Etudiant responsable</label>
        <select class="form-control" id="student_id" name="student_id" required>
            <option value="">Choisir un etudiant</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $campaign->student_id ?? '') == $student->id)>{{ $student->name }}</option>
            @endforeach
        </select>
        @error('student_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="title">Titre</label>
        <input class="form-control" id="title" name="title" value="{{ old('title', $campaign->title ?? '') }}" required>
        @error('title') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="category">Categorie</label>
        <input class="form-control" id="category" name="category" value="{{ old('category', $campaign->category ?? '') }}" required>
        @error('category') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="goal_amount">Objectif (DT)</label>
        <input class="form-control" id="goal_amount" type="number" step="0.01" min="50" name="goal_amount" value="{{ old('goal_amount', $campaign->goal_amount ?? '') }}" required>
        @error('goal_amount') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="deadline">Date limite</label>
        <input class="form-control" id="deadline" type="date" name="deadline" value="{{ old('deadline', isset($campaign) ? $campaign->deadline->format('Y-m-d') : '') }}" required>
        @error('deadline') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="status">Statut</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['draft' => 'Brouillon', 'active' => 'Active', 'funded' => 'Financee', 'closed' => 'Cloturee'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $campaign->status ?? 'active') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field full">
        <label for="image_url">Image URL</label>
        <input class="form-control" id="image_url" type="url" name="image_url" value="{{ old('image_url', $campaign->image_url ?? '') }}">
        @error('image_url') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field full">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $campaign->description ?? '') }}</textarea>
        @error('description') <div class="error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="actions">
    <x-button type="submit">{{ $submitLabel }}</x-button>
    <x-button :href="route('campaigns.index')" variant="secondary">Retour</x-button>
</div>
