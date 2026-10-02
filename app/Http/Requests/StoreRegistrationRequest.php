<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $activity = $this->route('activity');

        return [
            'participant_name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique(
                    'registrations',
                    'email'
                )->where(
                    fn ($query) =>
                        $query->where(
                            'activity_id',
                            $activity->id
                        )
                ),
            ],
        ];
    }
}