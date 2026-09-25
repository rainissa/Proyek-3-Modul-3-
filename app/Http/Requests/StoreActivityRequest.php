<?php

namespace App\Http\Requests;

use App\Traits\ValidatesActivityData;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    use ValidatesActivityData;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->activityRules();
    }
}
