<?php

namespace App\Http\Requests\Method;


use Illuminate\Foundation\Http\FormRequest;

class UpdateMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'activity_id' => 'required|unique:methods,activity_id,' . $this->route('method')->id . ',id,number,' . $this->number,
            'number' => 'required|unique:methods,number,' . $this->route('method')->id . ',id,activity_id,' . $this->activity_id,
            'note' => 'nullable',
        ];
    }

    /**
     * Возвращает правила валидации, применяемые к запросу.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'activity_id' => 'Активность',
            'number' => 'Номер занятия',
        ];
    }

    /**
     * Возвращает сообщения об ошибках валидации.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" обязательно для заполнения',
            'unique' => 'Запись уже существует в БД',
        ];
    }
}
