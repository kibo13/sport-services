<div class="modal fade" id="bk-place-modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content" action="{{ route('groups.place.bind') }}" method="POST">
            @csrf
            <div class="p-2 modal-header">
                <h5 class="modal-title">Настройка места</h5>
                <button class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-2 modal-body">
                <input type="hidden" id="js-place-id" name="place_id">
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.client') }}
                    </label>
                    <select id="js-place-client-id" name="client_id" required>
                        <option value="" hidden selected>Выбрать</option>
                    </select>
                </div>
            </div>
            <div class="p-2 modal-footer">
                <button class="mr-0 btn btn-success" type="submit">
                    {{ __('_action.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
