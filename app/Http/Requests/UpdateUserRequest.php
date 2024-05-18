<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\UniversityCareer;
use App\Models\User;
use App\Rules\InstitutionalEmailRule;
use App\Rules\ValidateAgeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = User::where('email', $this->email)->first();

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'student_number' => ['required', 'lowercase', 'string', 'min:9', 'max:9', 'regex:/^[a-z][0-9]*$/', Rule::unique(User::class, 'student_number')->ignore($user )],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', new InstitutionalEmailRule, Rule::unique(User::class, 'email')->ignore($user)],
            'birthday' => ['required', 'date', new ValidateAgeRule],
            'university_career' => ['required', 'string', 'exists:'.UniversityCareer::class.',name'],
            'role' => ['required', 'exists:'.Role::class.',name'],
        ];
    }
}
