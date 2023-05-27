const profileForm = document.getElementById('profile-form')

if (profileForm) {
    let phoneInput = document.getElementById('phone')
    let phoneMask = new Inputmask('+7 (999) 999-99-99')
    phoneMask.mask(phoneInput)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#profile-photo').on('change', function() {
        let file = this.files[0]

        if (file) {
            let formData = new FormData()
            formData.append('photo', file)

            $.ajax({
                url: '/profile/photo/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: response => $('#photo').attr('src', response.photo)
            })
        }
    })
}
