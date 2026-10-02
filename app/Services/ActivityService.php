<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ActivityService
{
    public function create(array $data): Activity
    {
        $poster = $data['poster'] ?? null;
        unset($data['poster']);

        if ($poster instanceof UploadedFile) {
            $path = $poster->store('posters', 'public');
            if ($path === false) {
                throw new \RuntimeException('Poster gagal disimpan.');
            }
            $data['poster_path'] = $path;
        }
        $data['status'] = 'draft';
        try {
            return Activity::create($data);
        } catch (\Throwable $exception) {
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            throw $exception;
        }
    }

    public function update(Activity $activity, array $data): Activity
    {
        $poster = $data['poster'] ?? null;
        unset($data['poster']);
        $oldPosterPath = $activity->poster_path;
        $newPosterPath = null;
        if ($poster instanceof UploadedFile) {
            $newPosterPath = $poster->store('posters', 'public');
            if ($newPosterPath === false) {
                throw new \RuntimeException('Poster gagal disimpan.');
            }
            $data['poster_path'] = $newPosterPath;
        }

        try {
            $activity->update($data);
        } catch (\Throwable $exception) {
            if ($newPosterPath !== null) {
                Storage::disk('public')->delete($newPosterPath);
            }
            throw $exception;
        }
        if (
            $newPosterPath !== null &&
            $oldPosterPath !== null &&
            $oldPosterPath !== $newPosterPath
        ) {
            Storage::disk('public')->delete($oldPosterPath);
        }
        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity{
        if ($activity->status !== 'draft') {
            throw new DomainException('Hanya kegiatan draft yang dapat dipublikasikan.');
        }
        $missing = $this->missingFields($activity);
        if ($missing !== []) {
            throw new DomainException(
                'Kegiatan belum bisa dipublikasikan. Lengkapi dulu: ' . implode(', ', $missing) . '.'
            );
        }
        if ($activity->end_at < $activity->start_at) {
            throw new DomainException('Waktu selesai tidak boleh lebih awal dari waktu mulai.');
        }
        if ($activity->capacity < 1 || $activity->capacity > 500) {
            throw new DomainException('Kapasitas harus antara 1 sampai 500.');
        }
        $activity->update(['status' => 'published']);

        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw new DomainException('Hanya kegiatan published yang dapat diselesaikan.');
        }
        $activity->update(['status' => 'completed']);

        return $activity->refresh();
    }

    private function missingFields(Activity $activity): array
    {
        $required = [
            'category_id' => 'kategori',
            'code' => 'kode',
            'title' => 'judul',
            'location' => 'lokasi',
            'start_at' => 'waktu mulai',
            'end_at' => 'waktu selesai',
            'capacity' => 'kapasitas',
        ];
        $missing = [];
        foreach ($required as $field => $label) {
            if (blank($activity->{$field})) {
                $missing[] = $label;
            }
        }

        return $missing;
    }
}
