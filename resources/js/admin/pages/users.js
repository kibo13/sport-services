const userForm = document.getElementById('user-form')

if (userForm) {
    $('#role').on('change', function (event) {
        let slug = $(this).find(':selected').data('slug')

        $('.bk-form__checkbox').prop('checked', false)

        switch (slug) {
            case 'admin':
            case 'director':
                $('.bk-form__checkbox').prop('checked', true)
                break

            case 'paymaster':
                $('.bk-form__checkbox').prop('checked', false)
                break

            case 'instructor':
                $('.bk-form__checkbox').prop('checked', false)
                break

            case 'doctor':
                $('.bk-form__checkbox').prop('checked', false)
                break

            case 'client':
                $('.bk-form__checkbox').prop('checked', false)
                break
        }
    })
}
