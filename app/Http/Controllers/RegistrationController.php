<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Activity;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function store(
        StoreRegistrationRequest $request,
        Activity $activity,
        RegistrationService $service
    ): RedirectResponse {
        $service->register(
            $activity,
            $request->validated()
        );

        return back()->with(
            'success',
            'Pendaftaran berhasil.'
        );
    }
}