const timetableOptionIndex = document.getElementById('timetable-option-index')

if (timetableOptionIndex) {
    const modal = document.getElementById('js-timetable-option-modal')

    $('.js-option-set').on('click', function (event) {
        let action = this.dataset.action
        let groupId = this.dataset.group
        let dayOfWeek = this.dataset.dow
        let startTime = this.dataset.start
        let duration = this.dataset.duration

        $('#js-action').val(action)
        $('#js-group-id').val(groupId)
        $('#js-day-of-week').val(dayOfWeek)
        $('#start').val(startTime)
        $('#duration').val(duration)

        modal.style.display = 'flex'
    })

    $('[data-modal=close]').on('click', function (event) {
        modal.style.display = 'none'
    })

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }
}
