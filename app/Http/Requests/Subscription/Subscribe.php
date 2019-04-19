<?php

namespace App\Http\Requests\Subscription;

use App\Events\Subscription\Subscribed;
use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Subscribe extends FormRequest
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
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique((new Subscription)->getTable())],
        ];
    }

    /**
     * @return Subscription
     */
    public function persist(): Subscription
    {
        $subscription = Subscription::firstOrCreate([
            'email' => $this->email,
        ], [
            'name' => $this->name,
        ]);

        event(new Subscribed($subscription));

        return $subscription;
    }
}
