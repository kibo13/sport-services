import InputMask from 'inputmask'

let phoneInput = document.getElementById('phone')
let phoneMask = new Inputmask('+7 (999) 999-99-99')

phoneMask.mask(phoneInput)
