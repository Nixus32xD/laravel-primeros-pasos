<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            // 'slug' => Str::slug($this->title)
            // 'slug' => Str::of($this->titlte)->slug()->append('-adicional')
            'slug'=> str($this->title)->slug()
        ]);
    }


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
            'title'=> 'required|min:5|max:500',
            'slug'=> 'required|min:5|max:500|unique:posts,slug,'.$this->route('post')->id,
            'content'=> 'required|min:10',
            'category_id'=> 'required|integer',
            'description'=> 'required|min:5|max:500',
            'posted'=> 'required',
            'image'=> 'mimes:jpeg,jpg,png,webp|max:10240'
        ];
    }
}
