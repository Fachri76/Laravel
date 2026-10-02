<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(
        Activity $activity,
        array $data
    ): Registration {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'registration' =>
                    'Pendaftaran hanya untuk Activity published.',
            ]);
        }

        if (
            $activity->start_at !== null &&
            $activity->start_at->isPast()
        ) {
            throw ValidationException::withMessages([
                'registration' =>
                    'Pendaftaran ditolak karena Activity sudah dimulai.',
            ]);
        }

        if (
            $activity->registered_count
            >= $activity->capacity
        ) {
            throw ValidationException::withMessages([
                'registration' =>
                    'Kapasitas Activity sudah penuh.',
            ]);
        }

        if (
            $activity->registrations()
                ->where('email', $data['email'])
                ->exists()
        ) {
            throw ValidationException::withMessages([
                'email' =>
                    'Email sudah terdaftar pada Activity ini.',
            ]);
        }

        return DB::transaction(
            function () use ($activity, $data) {
                $registration =
                    $activity->registrations()->create([
                        'participant_name' =>
                            $data['participant_name'],

                        'email' =>
                            $data['email'],

                        'registered_at' =>
                            now(),
                    ]);

                $activity->increment(
                    'registered_count'
                );

                return $registration;
            }
        );
    }
}