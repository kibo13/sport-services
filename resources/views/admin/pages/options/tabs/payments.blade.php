<div class="bk-form">
    <div class="bk-form__wrapper">
        @foreach($options as $option)
            <div class="bk-form__field">
                <label class="bk-form__label">
                    {{ $option->comment }}
                </label>
                <form class="d-flex bk-gap-5" action="{{ route('options.update', $option) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="{{ $option->section }}">
                    <input type="number"
                           class="form-control bk-max-w-250"
                           name="value"
                           min="1"
                           step="1"
                           value="{{ $option->value ?? null }}">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
