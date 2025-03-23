<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $id = $this->route('article'); // Lấy ID từ route

        $titleRule = $this->isMethod('post')
            ? 'required|unique:articles,title'
            : 'sometimes|unique:articles,title,' . $id;

        return [
            'title' => $titleRule,
            'content' => $this->isMethod('post') ? 'required' : 'sometimes',
            'image' => $this->isMethod('post') ? 'required' : 'sometimes',
            'status' => $this->isMethod('post') ? 'required' : 'sometimes',
            'id_author' => $this->isMethod('post') ? 'required' : 'sometimes',
            'id_subitem' => $this->isMethod('post') ? 'required' : 'sometimes',
        ];
    }
}
