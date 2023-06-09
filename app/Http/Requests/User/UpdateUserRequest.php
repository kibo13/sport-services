<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * This method is automatically called before the validation rules are applied to the request.
     * It allows you to modify or manipulate the input data before the validation occurs.
     */
    public function prepareForValidation()
    {
        $this->merge([
            'phone' => format_phone_number_for_storage($this->input('phone')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required',
            'name'    => 'required',
            'surname' => 'required',
            'phone'   => 'required|unique:users,phone,' . $this->route('user')->id,
            'email'   => 'required|unique:users,email,' . $this->route('user')->id,
        ];
    }

    /**
     * Get the readable attribute names for validation.
     *
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'role_id'    => 'Роль',
            'name'       => 'Имя',
            'surname'    => 'Фамилия',
            'patronymic' => 'required',
            'phone'      => 'Телефон',
            'email'      => 'E-mail',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле ":attribute" обязательно для заполнения',
            'unique'   => 'Данный ":attribute" уже занят',
        ];
    }
}
