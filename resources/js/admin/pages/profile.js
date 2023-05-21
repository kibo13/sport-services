const profile_form = document.getElementById('profile-form')

if (profile_form) {
    let phoneInput = document.getElementById('phone');
    let phoneMask = new Inputmask('+7 (999) 999-99-99');
    phoneMask.mask(phoneInput);
}
