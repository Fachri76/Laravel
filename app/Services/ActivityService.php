<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class ActivityService
{
    public function create(array $data): Activity
    {
        $poster = $data['poster'] ?? null;

        unset($data['poster']);

        if ($poster instanceof UploadedFile) {
            $data['poster_path'] = $poster->store(
                'posters',
                'public'
            );
        }

        $data['status'] = 'draft';

        return Activity::create($data);
    }

    public function update(
        Activity $activity,
        array $data
    ): Activity {
        $poster = $data['poster'] ?? null;

        unset($data['poster']);

        $oldPoster = $activity->poster_path;
        $newPoster = null;

        if ($poster instanceof UploadedFile) {
            $newPoster = $poster->store(
                'posters',
                'public'
            );

            $data['poster_path'] = $newPoster;
        }

        try {
            $activity->update($data);
        } catch (Throwable $exception) {
            if ($newPoster !== null) {
                Storage::disk('public')->delete($newPoster);
            }

            throw $exception;
        }

        if (
            $newPoster !== null &&
            $oldPoster !== null
        ) {
            Storage::disk('public')->delete($oldPoster);
        }

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' =>
                    'Hanya kegiatan draft yang dapat dipublikasikan.',
            ]);
        }

        $requiredFields = [
            'category_id',
            'code',
            'title',
            'location',
            'start_at',
            'end_at',
            'capacity',
        ];

        foreach ($requiredFields as $field) {
            if (blank($activity->{$field})) {
                throw ValidationException::withMessages([
                    'status' =>
                        'Data kegiatan belum lengkap untuk dipublikasikan.',
                ]);
            }
        }

        $activity->update([
            'status' => 'published',
        ]);

        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' =>
                    'Hanya kegiatan published yang dapat diselesaikan.',
            ]);
        }

        $activity->update([
            'status' => 'completed',
        ]);

        return $activity->refresh();
    }
}