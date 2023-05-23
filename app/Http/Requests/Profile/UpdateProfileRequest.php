<?php

namespace App\Http\Requests\Profile;


use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * Get all of the input and files for the request.
     *
     * @param  array|null  $keys
     * @return array
     */
    public function all($keys = null): array
    {
        $data = parent::all($keys);

        if (is_null($data['password'])) {
            unset($data['password'], $data['password_confirmation']);
        }

        return $data;
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
            'patronymic' => 'nullable',
            'birthday'   => 'nullable',
            'phone'      => 'required|unique:users,phone,' . auth()->id(),
            'email'      => 'required|unique:users,email,' . auth()->id(),
            'address'    => 'nullable',
            'password'   => 'nullable|confirmed|min:8',
            'is_notify'  => 'nullable',
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
            'phone'    => 'Телефон',
            'email'    => 'E-mail',
            'password' => 'Пароль',
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
            'unique' => 'Данный ":attribute" уже занят',
            'password.min' => 'Минимальная длина пароля должна быть :min символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
