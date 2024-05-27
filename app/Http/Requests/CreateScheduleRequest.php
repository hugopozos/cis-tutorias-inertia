<?php

namespace App\Http\Requests;

use App\Enums\ClassroomTypeEnum;
use App\Models\Course;
use App\Rules\ClassroomLocationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateScheduleRequest extends FormRequest
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
        Validator::extend('end_date_after_or_same_if_days_null', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            if (empty($data['days_of_week'])) {
                return $data['start_date'] <= $value;
            }
            return $data['start_date'] < $value;
        });

        Validator::extend('nullable_if_same_day', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            return $data['start_date'] !== $data['end_date'] || empty($value);
        });

        return [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:50'],
            'course' => ['required', Rule::exists('courses', 'id')],
            'classroom_type' => ['required', 'string', Rule::in(ClassroomTypeEnum::getValues())],
            'classroom_location' => ['required', 'max:100', ],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'end_date_after_or_same_if_days_null'],
            'start_time' => ['required', 'date_format:H:i'],
            'days_of_week' => ['array', 'nullable_if_same_day'],
            'max_students' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('classroom_location', 'url', function ($input) {
            return $input->classroom_type === 'virtual';
        });
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción',
            'course' => 'materia',
            'classroom_type' => 'tipo de aula',
            'classroom_location' => 'ubicación',
            'start_date' => 'fecha de inicio',
            'end_date' => 'fecha de fin',
            'start_time' => 'hora de inicio',
            'days_of_week' => 'días de la semana',
            'max_students' => 'máximo de estudiantes',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no debe ser mayor a 50 caracteres.',
            'description.required' => 'La descripción es requerida.',
            'description.max' => 'La descripción no debe ser mayor a 50 caracteres.',
            'course.required' => 'La materia es requerida.',
            'course.exists' => 'La materia no existe.',
            'classroom_type.required' => 'El tipo de aula es requerido.',
            'classroom_type.string' => 'El tipo de aula debe ser una cadena de texto.',
            'classroom_type.in' => 'El tipo de aula debe ser física o virtual.',
            'classroom_location.required' => 'La ubicación es requerida.',
            'classroom_location.max' => 'La ubicación no debe ser mayor a 100 caracteres.',
            'start_date.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual.',
            'end_date.end_date_after_or_same_if_days_null' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            'start_time.date_format' => 'La hora de inicio debe tener el formato HH:MM.',
            'days_of_week.nullable_if_same_day' => 'Los días de la semana no pueden ser nulos si la fecha de inicio y fin son iguales.',
            'max_students.min' => 'El máximo de estudiantes debe ser al menos 1.',
            'classroom_location.url' => 'La ubicación debe ser una URL válida cuando el tipo de aula es virtual.',
        ];
    }
}
