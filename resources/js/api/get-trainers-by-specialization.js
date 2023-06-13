import axios from 'axios'

const specializationSelect = document.getElementById('specialization_id')
const trainerSelect = document.getElementById('trainer_id')

function updateTrainerOptions(specializationId) {
    // Сохраняем выбранное значение
    const selectedTrainer = trainerSelect.value

    if (specializationId) {
        axios.get('/api/specializations/get-trainers-by-specialization', {
            params: { 'specialization_id': specializationId }
        }).then(function (response) {
            if (response.data.status) {
                const options = response.data.option
                trainerSelect.innerHTML = options

                // Восстанавливаем выбранное значение, если оно присутствует в новом списке
                if (selectedTrainer && trainerSelect.querySelector(`option[value="${selectedTrainer}"]`)) {
                    trainerSelect.value = selectedTrainer
                }
            }
        }).catch(function (error) {
            console.log(error)
        })
    }
}

specializationSelect.addEventListener('change', function () {
    let specializationId = this.value
    updateTrainerOptions(specializationId)
})

// Обновляем список тренеров при загрузке страницы, если выбрано начальное значение
updateTrainerOptions(specializationSelect.value)
