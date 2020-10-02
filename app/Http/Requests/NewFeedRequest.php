<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewFeedRequest extends FormRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'feed_url' => 'required|url',
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages()
    {
        return [
            'url' => 'The feed URL must be a valid URL.',
        ];
    }
}
