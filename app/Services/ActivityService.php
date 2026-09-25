<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;

class ActivityService
{
    private const TRANSITIONS = [
        'Planned' => [
            'Planned',
            'Ongoing',
        ],

        'Ongoing' => [
            'Ongoing',
            'Done',
        ],

        'Done' => [
            'Done',
        ],
    ];

    public function create(
        array $validatedData
    ): Activity {
        return Activity::create(
            $validatedData
        );
    }

    public function update(
        Activity $activity,
        array $validatedData
    ): Activity {
        $nextStatus =
            $validatedData['status']
            ?? $activity->status;

        $this->ensureValidTransition(
            $activity->status,
            $nextStatus
        );

        $activity->update(
            $validatedData
        );

        return $activity->refresh();
    }

    private function ensureValidTransition(
        string $current,
        string $next
    ): void {
        $allowed =
            self::TRANSITIONS[$current]
            ?? [];

        if (! in_array(
            $next,
            $allowed,
            true
        )) {
            throw new DomainException(
                "Transisi status {$current} ke {$next} tidak diizinkan."
            );
        }
    }
}
