<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public const STATUSES = [
        'Planned',
        'Ongoing',
        'Done',
    ];

    protected $fillable = [
        'title',
        'description',
        'activity_date',
        'category',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

    public function scopeFilterStatus(
        Builder $query,
        ?string $status
    ): Builder {
        if (! in_array(
            $status,
            self::STATUSES,
            true
        )) {
            return $query;
        }

        return $query->where(
            'status',
            $status
        );
    }
}
