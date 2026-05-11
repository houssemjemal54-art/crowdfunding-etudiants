<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'category',
        'description',
        'goal_amount',
        'deadline',
        'status',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'goal_amount' => 'decimal:2',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    protected function collectedAmount(): Attribute
    {
        return Attribute::get(fn (): float => (float) $this->contributions()->sum('amount'));
    }

    protected function progress(): Attribute
    {
        return Attribute::get(function (): int {
            if ((float) $this->goal_amount <= 0) {
                return 0;
            }

            return min(100, (int) round(($this->collected_amount / (float) $this->goal_amount) * 100));
        });
    }
}
