$(document).on('click', '.bk-btn-action--user', (event) => {
    let placeId = $(event.target).data('id')
    let fullName = $(event.target).data('full-name')
    let phone = $(event.target).data('phone')
    let photo = $(event.target).data('photo')

    $('#js-client-place-id').val(placeId)
    $('#js-client-full-name').val(fullName)
    $('#js-client-phone').val(phone)
    $('#js-client-photo').attr('src', photo)
})
