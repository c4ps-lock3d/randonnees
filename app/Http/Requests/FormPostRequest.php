<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            //'slug' => ['required', 'min:8', 'regex:/^[0-9a-z\-]+$/', 'unique:posts'],
            'slug' => ['required', 'min:8', 'regex:/^[0-9a-z\-]+$/', Rule::unique('gpxes')->ignore($this->route()->parameter('postgpx'))],
            'date' => ['required'],
            'cat_area_id' => ['required', 'exists:cat_areas,id'],
            'cat_layout_id' => ['required', 'exists:cat_layouts,id'],
            'cat_topography_id' => ['required', 'exists:cat_topographies,id'],
            'cat_difficulty_id' => ['required', 'exists:cat_difficulties,id'],
            'cat_dogfriendly_id' => ['required', 'exists:cat_dogfriendlies,id'],
            'distance' => ['required'],
            'eleAsc' => ['numeric', 'min_digits:1', 'max_digits:4'],
            'eleDsc' => ['numeric', 'min_digits:1', 'max_digits:4'],
            'distEff' => ['required'],
            'eleStart' => ['numeric', 'min_digits:1', 'max_digits:4'],
            'eleMax' => ['numeric', 'min_digits:1', 'max_digits:4'],
            'duration' => ['required'],
            'google' => ['nullable'],
            'hut' => ['nullable'],
            'comments' => ['nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
            'distEff' => round($this->input('distance')+$this->input('eleAsc')/100+$this->input('eleDsc')/400, 1)
        ]);
    
    }
}
