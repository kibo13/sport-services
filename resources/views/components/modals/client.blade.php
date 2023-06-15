<div class="modal fade" id="bk-client-modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content" action="{{ route('groups.place.unbind') }}" method="POST">
            @csrf
            <div class="p-2 modal-header">
                <h5 class="modal-title">{{ __('_field.client') }}</h5>
                <button class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-2 modal-body">
                <input type="hidden" id="js-client-place-id" name="place_id">
                <div class="bk-form__field">
                    <img class="bk-form__photo w-100" id="js-client-photo">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">{{ __('_field.fio') }}</label>
                    <input type="text" class="bk-form__input" id="js-client-full-name" readonly/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">{{ __('_field.phone') }}</label>
                    <input type="text" class="bk-form__input" id="js-client-phone" readonly/>
                </div>
            </div>
            <div class="p-2 modal-footer">
                <button class="mr-0 btn btn-success" data-dismiss="modal">
                    {{ __('_action.save') }}
                </button>
                <button class="btn btn-danger" type="submit">
                    {{ __('_action.unbind') }}
                </button>
            </div>
        </form>
    </div>
</div>
