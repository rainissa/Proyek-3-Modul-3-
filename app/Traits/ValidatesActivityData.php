<?php

namespace App\Traits;

use Illuminate\Validation\Rule;

trait ValidatesActivityData
{
    protected function activityRules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('activities', 'code')->ignore($this->route('activity')),
            ],
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'start_at' => ['nullable', 'date'],
            'end_at' => [
                'nullable',
                'date',
                Rule::when($this->filled('start_at'), 'after_or_equal:start_at'),
            ],
            'location' => ['nullable', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1', 'max:500'],
        ];
    }
}
