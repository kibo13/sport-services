const userForm = document.getElementById('user-form')

if (userForm) {
    const roles = {
        'admin': [
            '.service_read',
            '.card_read',
            '.timetable_read',
            '.lesson_full',
            '.group_read', '.group_full',
            '.client_read', '.client_full',
            '.trainer_read', '.trainer_full',
            '.report_read'
        ],
        'director': [
            '.benefit_read',
            '.pay_read',
            '.specialization_read',
            '.education_read',
            '.service_read',
            '.card_read',
            '.timetable_read',
            '.group_read',
            '.client_read',
            '.medical_read',
            '.trainer_read',
            '.event_read',
            '.report_read',
            '.stat_read'
        ],
        'paymaster': [
            '.benefit_read',
            '.pay_read', '.pay_full',
            '.service_read', '.service_full',
            '.card_read', '.card_full',
            '.option_read', '.option_full'
        ],
        'instructor': [
            '.service_read',
            '.timetable_read',
            '.group_read',
            '.event_read', '.event_full'
        ],
        'doctor': [
            '.service_read',
            '.client_read',
            '.medical_read', '.medical_full',
            '.trainer_read'
        ],
        'methodist': [
            '.service_read',
            '.timetable_read', '.timetable_full'
        ],
        'client': [
            '.service_read',
            '.timetable_read',
            '.lesson_read',
            '.trainer_read'
        ]
    }

    userForm.addEventListener('change', function (event) {
        const roleSelect = event.target
        const slug = roleSelect.options[roleSelect.selectedIndex].dataset.slug

        const checkboxes = userForm.getElementsByClassName('bk-form__checkbox')
        Array.from(checkboxes).forEach(function (checkbox) {
            checkbox.checked = false
        })

        if (roles.hasOwnProperty(slug)) {
            roles[slug].forEach( role => {
                const elements = userForm.querySelectorAll(role)
                Array.from(elements).forEach( element => element.checked = true)
            })
        }
    })
}
