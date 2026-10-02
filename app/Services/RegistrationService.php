<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        $this->ensureCanRegister($activity, $data['email']);

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }

    private function ensureCanRegister(Activity $activity, string $email): void
    {
        if ($activity->status !== 'published') {
            throw new DomainException('Pendaftaran hanya untuk kegiatan yang sudah dipublikasikan.');
        }

        if ($activity->start_at === null || $activity->start_at->isPast()) {
            throw new DomainException('Pendaftaran ditutup karena kegiatan sudah dimulai.');
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw new DomainException('Kapasitas kegiatan sudah penuh.');
        }

        if ($activity->registrations()->where('email', $email)->exists()) {
            throw new DomainException('Email ini sudah terdaftar pada kegiatan ini.');
        }
    }
}