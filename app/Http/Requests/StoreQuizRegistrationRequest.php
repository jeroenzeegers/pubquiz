<?php

namespace App\Http\Requests;

use App\Models\QuizRegistration;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'team_size' => [
                'required',
                'integer',
                'min:1',
                'max:8',
                function ($attribute, $value, $fail) {
                    $currentTotal = QuizRegistration::sum('team_size');
                    if ($currentTotal + $value > 75) {
                        $remaining = 75 - $currentTotal;
                        $fail("Er zijn nog maar {$remaining} plekken beschikbaar. Jouw team van {$value} personen past helaas niet meer.");
                    }
                },
            ],
            'email' => ['required', 'email', 'max:255'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Teamnaam is verplicht.',
            'name.max' => 'Teamnaam mag maximaal 255 karakters bevatten.',
            'contact_name.required' => 'Naam contactpersoon is verplicht.',
            'contact_name.max' => 'Naam contactpersoon mag maximaal 255 karakters bevatten.',
            'team_size.required' => 'Aantal personen in team is verplicht.',
            'team_size.integer' => 'Aantal personen moet een geldig getal zijn.',
            'team_size.min' => 'Een team moet minimaal 1 persoon bevatten.',
            'team_size.max' => 'Een team mag maximaal 8 personen bevatten.',
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Voer een geldig e-mailadres in.',
            'email.max' => 'E-mailadres mag maximaal 255 karakters bevatten.',
        ];
    }
}
