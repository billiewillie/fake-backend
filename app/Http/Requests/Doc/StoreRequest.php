<?php

    namespace App\Http\Requests\Doc;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreRequest extends FormRequest
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
         * @return array<string, array|string>
         */
        public function rules(): array
        {
            return [
                "title" => "required|string",
                "author_id" => "required|integer|exists:users,id",
                "department_id" => "required|integer|exists:departments,id",
                "file" => "required|file|max:5120",
                "is_published" => "boolean",
                'published_date' => "required_if:is_published,false|date_format:Y-m-d",
            ];
        }
    }
