<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('slug', 'unique:articles', function ($input) {
            if ($this->route()->hasParameter('article')) {
                $model = $this->route()->parameter('article');

                return (($model->slug !== $input->slug) && $input->slug);
            }
            return !empty($input->slug);
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'text' => 'required|min:6'
        ];
    }
}
