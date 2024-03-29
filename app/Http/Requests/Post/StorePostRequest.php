<?php

namespace App\Http\Requests\Post;

use App\Models\Website;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePostRequest extends FormRequest
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
            'website' => ['bail', 'required', 'string', 'ulid'],
            'title' => ['required', 'string', 'min:4', 'max:128'],
            'description' => ['required', 'string', 'min:4', 'max:512'],
            'keywords' => ['array', 'min:1', 'max:5'],
            'keywords.*' => ['string', 'min:1', 'max:18'],
            'content' => ['required', 'string', 'min:4', 'max:10250'],
        ];
    }

    public function after(): array
    {
        return [
            fn (Validator $validator) => $this->validateWebsite($validator),
        ];
    }

    protected function validateWebsite(Validator $validator): void
    {
        try {
            $website = Website::findOrFail($this->input('website'));

            // @todo: Check user can post to website when implemented

            $this->merge(['website' => $website]);
        } catch (\Throwable $th) {
            $validator->errors()->add(
                'website',
                'The website could not be found.'
            );
        }
    }
}
