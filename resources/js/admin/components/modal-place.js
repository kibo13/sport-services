import { initializeSelect2 } from '../../helpers/select2'

$(document).on('click', '.bk-btn-action--plus', (event) => {
    let placeId = $(event.target).data('id')
    $('#js-place-id').val(placeId)

    initializeSelect2('js-place-client-id', '/api/clients/search', function(client) {
        return `${client.full_name}`;
    })
})
