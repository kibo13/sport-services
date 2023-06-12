<form class="my-2 bk-form js-report-form rounded d-none"
      id="js-report-clients"
      action="{{ route('reports.clients') }}"
      method="GET">
    <div class="bk-form__wrapper">
        <div class="mt-1 mb-0">
            <button class="btn btn-primary">
                {{ __('_action.generate') }}
            </button>
        </div>
    </div>
</form>
