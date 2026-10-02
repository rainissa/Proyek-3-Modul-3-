<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'status',
        'category_id',
        'code',
        'poster_path'
    ];

    protected function casts(): array
    {
        return [
            'start_at'=> 'datetime',
            'end_at'=> 'datetime',
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
    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('code', 'like', "%{$keyword}%");
            });
        });
    }

    public function scopeOfCategory(Builder $query, int $categoryId): Builder
    {
        return $query->when($categoryId, fn ($query, $id) => $query->where('category_id', $id));
    }

    public function scopeOfStatus(Builder $query, string $status): Builder
    {
        return $query->when(
            in_array($status, ['draft', 'published', 'completed'], true),
            fn ($query) => $query->where('status', $status)
        );
    }

    public function scopeSortByStart(Builder $query, string $direction): Builder
    {
        return $query->orderBy('start_at', $direction === 'terlama' ? 'asc' : 'desc');
    }
}
