<?php

    namespace App\Http\Requests\Post;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateRequest extends FormRequest
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
         * @return array<string, Illuminate\Contracts\Validation\Rule|array|string>
         */
        public function rules(): array
        {
            return [
                "title" => "string",
                "category_id" => "integer|exists:categories,id",
                "is_published" => "required|boolean",
                "description" => "min:3|max:200",
                "content" => "min:3",
                "preview_image" => "image",
                'published_date' => "required_if:is_published,false|date_format:Y-m-d",
            ];
        }
    }
