$(document).on('click', '.bk-btn-action--delete', (e) => {

    let table = $(e.target).data('table')
    let url = $(location).attr('pathname')
    let recordId = $(e.target).data('id')

    switch (table) {
        case 'timetable-option':
            $('#bk-delete-form').attr('action', `/timetable/${recordId}`)
            break

        default:
            $('#bk-delete-form').attr('action', `${url}/${recordId}`)
            break
    }
})
