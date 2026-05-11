@csrf

<div class="form-grid">
    <div class="field">
        <label for="name">Nom complet</label>
        <input class="form-control" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="university">Universite</label>
        <input class="form-control" id="university" name="university" value="{{ old('university', $student->university ?? '') }}" required>
        @error('university') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label for="major">Specialite</label>
        <input class="form-control" id="major" name="major" value="{{ old('major', $student->major ?? '') }}" required>
        @error('major') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field full">
        <label for="bio">Bio</label>
        <textarea class="form-control" id="bio" name="bio" rows="5">{{ old('bio', $student->bio ?? '') }}</textarea>
        @error('bio') <div class="error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="actions">
    <x-button type="submit">{{ $submitLabel }}</x-button>
    <x-button :href="route('students.index')" variant="secondary">Retour</x-button>
</div>
