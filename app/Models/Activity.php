<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    public const STATUSES = [
        'draft',
        'published',
        'completed',
    ];

    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'status',
        'poster_path',
        'registered_count',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'capacity' => 'integer',
            'registered_count' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function scopeSearch(
        Builder $query,
        ?string $keyword
    ): Builder {
        if (blank($keyword)) {
            return $query;
        }

        return $query->where(function (Builder $query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                ->orWhere('code', 'like', "%{$keyword}%");
        });
    }

    public function scopeFilterCategory(
        Builder $query,
        ?string $categoryId
    ): Builder {
        if (blank($categoryId)) {
            return $query;
        }

        return $query->where('category_id', $categoryId);
    }

    public function scopeFilterStatus(
        Builder $query,
        ?string $status
    ): Builder {
        if (
            blank($status) ||
            ! in_array($status, self::STATUSES, true)
        ) {
            return $query;
        }

        return $query->where('status', $status);
    }
}