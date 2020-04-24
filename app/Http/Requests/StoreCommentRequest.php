<?php

namespace App\Http\Requests;

use App\Rules\Comment\IsDeletedRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCommentRequest
 *
 * @package App\Http\Requests
 */
class StoreCommentRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function rules()
    {
        return [
            'content' => 'required',
            'parent_id' => new IsDeletedRule()
        ];
    }
}
