<?php

namespace App\Http\Requests\Campaigns;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasVerifiedEmail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'string|min:3|max:30',
            'reply_to' => 'nullable|email|min:3|max:30',
            'subject' => 'nullable|string|min:3|max:50',
            'preview_text' => 'nullable|string|max:150',
            'html_content' => 'nullable|string|max:65535',
            'type' => 'nullable|string|in:html,text,plain',
            'status' => 'nullable|string|in:active,inactive',
        ];
    }
}
