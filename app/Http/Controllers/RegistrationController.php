<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Activity;
use App\Services\RegistrationService;
use DomainException;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function store(
        StoreRegistrationRequest $request,
        Activity $activity,
        RegistrationService $service
    ): RedirectResponse {
        try {
            $service->register($activity, $request->validated());
        } catch (DomainException $exception) {
            return back()
                ->with('error', $exception->getMessage())
                ->withInput();
        }

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Pendaftaran berhasil.');
    }
}
