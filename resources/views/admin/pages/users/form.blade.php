@extends('admin.index')

@section('title-admin', __('_section.users'))

@section('content-admin')
    <section id="users-form">
        <h3>{{ isset($user) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($user)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="surname">
                        Фамилия
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="surname"
                           type="text"
                           name="surname"
                           value="{{ isset($user) ? $user->surname : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="name">
                        Имя
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="name"
                           type="text"
                           name="name"
                           value="{{ isset($user) ? $user->name : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="patronymic">
                        Отчество
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="patronymic"
                           type="text"
                           name="patronymic"
                           value="{{ isset($user) ? $user->patronymic : null }}"/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="phone">
                        Телефон
                    </label>
                    <input class="bk-form__input bk-max-w-300 @error('phone') border border-danger @enderror"
                           id="phone"
                           type="text"
                           name="phone"
                           value="{{ isset($user) ? $user->phone : null }}"
                           required/>
                    @error('phone')
                    <small class="bk-validation">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="email">
                        E-mail
                    </label>
                    <input class="bk-form__input bk-max-w-300 @error('email') border border-danger @enderror"
                           id="email"
                           type="email"
                           name="email"
                           value="{{ isset($user) ? $user->email : null }}"
                           required/>
                    @error('email')
                    <small class="bk-validation">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="role">
                        Роль
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="role" name="role_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                                data-slug="{{ $role->slug }}"
                                @isset($user) @if($user->role_id == $role->id) selected @endif @endisset>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="">
                        Права
                    </label>
                    <table class="dataTables table table-bordered table-hover table-responsive">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th class="w-50 text-left bk-min-w-200">{{ __('_section.sections') }}</th>
                            <th class="w-25 text-center bk-min-w-150">{{ __('_action.looking') }}</th>
                            <th class="w-25 text-center bk-min-w-150">{{ __('_action.editing') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $section->name }}</td>
                                @if($permissions->where('name', $section->name)->count() == 2)
                                @foreach($permissions as $permission)
                                @if($permission->name == $section->name)
                                <td class="text-center">
                                    <input class="bk-form__checkbox {{ $permission->slug }}"
                                           name="permissions[]"
                                           type="checkbox"
                                           value="{{ $permission->id }}"
                                           @isset($user) @if($user->permissions->where('id', $permission->id)->count()) checked="checked" @endif @endisset>
                                </td>
                                @endif
                                @endforeach
                                @else
                                @foreach($permissions as $permission)
                                @if($permission->name == $section->name)
                                <td class="text-center">
                                    <input class="bk-form__checkbox {{ $permission->slug }}"
                                           name="permissions[]"
                                           type="checkbox"
                                           value="{{ $permission->id }}"
                                           @isset($user) @if($user->permissions->where('id', $permission->id)->count())
                                           checked="checked"
                                        @endif @endisset>
                                </td>
                                <td class="text-center font-weight-bold">-</td>
                                @endif
                                @endforeach
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
