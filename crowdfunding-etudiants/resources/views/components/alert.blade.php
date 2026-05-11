@if (session('success'))
    <div class="notice">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="notice" style="border-color:#f2b8b5;background:#fff1f0;color:#842029;">
        Merci de corriger les champs signales.
    </div>
@endif
