import axios from 'axios'
const eventForm = document.getElementById('event-form')

if (eventForm) {
    $('#specialization_id').change(function () {
        let specializationId = $(this).val()

        if (specializationId) {
            axios({
                method: 'GET',
                url: '/api/specializations/get-trainers-by-specialization',
                params: { 'specialization_id': specializationId }
            }).then((response) => {
                if(response.data.status) {
                    $('#trainer_id').html(response.data.option)
                }
            })
        }

        return false
    })
}
