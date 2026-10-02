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
            'activity_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['Planned', 'Ongoing', 'Done'])],
        ];
    }
}
