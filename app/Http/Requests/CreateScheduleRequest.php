<?php

namespace App\Http\Requests;

use App\Enums\ClassroomTypeEnum;
use App\Models\Course;
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
            'classroom_location' => ['required', 'max:100', $this->getClassroomLocationRule()],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'end_date_after_or_same_if_days_null'],
            'start_time' => ['required', 'date_format:H:i'],
            'days_of_week' => ['array', 'nullable_if_same_day'],
            'max_students' => ['required', 'integer', 'min:1'],
        ];
    }

    private function getClassroomLocationRule(): string
    {
        if ($this->input('classroom_type') === ClassroomTypeEnum::VIRTUAL) {
            return 'url';
        }

        return 'string';
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
}
