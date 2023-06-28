<form class="my-2 bk-form js-report-form rounded d-none"
      id="js-report-results"
      action="{{ route('reports.results') }}"
      method="GET">
    <div class="bk-form__wrapper">
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.period') }}
            </label>
            <div class="bk-grid bk-grid--gtc-150">
                <input class="bk-form__input"
                       id="report-from"
                       type="date"
                       name="from"
                       value="{{ request()->from ? request()->from : null }}"
                       required/>
                <input class="bk-form__input"
                       id="report-till"
                       type="date"
                       name="till"
                       value="{{ request()->till ? request()->till : null }}"
                       required/>
            </div>
        </div>
        <div class="mt-1 mb-0">
            <button class="btn btn-primary">
                {{ __('_action.generate') }}
            </button>
        </div>
    </div>
</form>
