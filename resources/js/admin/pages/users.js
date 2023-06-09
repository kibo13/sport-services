const userForm = document.getElementById('user-form')

if (userForm) {
    const rolePermissions = {
        admin: [
            '.service_read',
            '.card_read',
            '.timetable_read',
            '.lesson_full',
            '.group_read', '.group_full',
            '.client_read', '.client_full',
            '.trainer_read', '.trainer_full',
            '.report_read'
        ],
        director: [
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
        paymaster: [
            '.benefit_read',
            '.pay_read', '.pay_full',
            '.service_read', '.service_full',
            '.card_read', '.card_full',
            '.option_read', '.option_full'
        ],
        instructor: [
            '.service_read',
            '.timetable_read',
            '.group_read',
            '.event_read', '.event_full'
        ],
        doctor: [
            '.service_read',
            '.client_read',
            '.medical_read', '.medical_full',
            '.trainer_read'
        ],
        methodist: [
            '.service_read',
            '.timetable_read', '.timetable_full'
        ],
        client: [
            '.service_read',
            '.timetable_read',
            '.lesson_read',
            '.trainer_read'
        ]
    }

    $('#role').on('change', function(event) {
        let slug = $(this).find(':selected').data('slug')
        const permissions = rolePermissions[slug]

        if (permissions) {
            $('.bk-form__checkbox').prop('checked', false)
            permissions.forEach(permission => $(permission).prop('checked', true))
        }
    })
}
