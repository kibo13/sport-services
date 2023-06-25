import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import { initializeSelect2 } from '../../helpers/select2'

const timetableIndex = document.getElementById('timetable-index')

if (timetableIndex) {
    const permission = document.getElementById('js-timetable-permission').value
    const modal = document.getElementById('js-timetable-modal')
    const timetable = document.getElementById('js-timetable-calendar')
    const calendar = new Calendar(timetable, {
        locale: 'ru',
        firstDay: 1,
        editable: false,
        initialView: 'dayGridMonth',
        plugins: [
            interactionPlugin,
            dayGridPlugin,
            timeGridPlugin
        ],

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek',
        },

        buttonText: {
            today: 'Сегодня',
            month: 'Месяц',
            week:  'Неделя',
            day:   'День',
            list:  'Список'
        },

        eventClassNames(arg) {
            let trainer    = arg.event.extendedProps.trainer_id
            let subTrainer = arg.event.extendedProps.is_replace

            if (trainer != subTrainer) return ['bk-timetable--replace']
        },

        eventDidMount(info) {
            const data = {
                title: info.event.title,
                id: info.event.extendedProps.timetable_id,
                activity: info.event.extendedProps.activity,
                activity_id: info.event.extendedProps.activity_id,
                group: info.event.extendedProps.group,
                trainer: info.event.extendedProps.trainer,
                trainer_id: info.event.extendedProps.trainer_id,
                note: info.event.extendedProps.note,
                bgColor: info.event.extendedProps.bgColor,
            }

            info.el.style.background = data.bgColor
            info.el.style.color = '#f8fafc'

            if (permission) {
                $(info.el).on('click', function (event) {
                    $('[data-field=timetable-id]').val(data.id)
                    $('[data-field=activity]').val(data.activity)
                    $('[data-field=group]').val(data.group)
                    $('[data-field=time-lesson]').val(data.title)
                    $('[data-field=trainer]').val(data.trainer)
                    $('[data-field=trainer-id]').val('')
                    $('[data-field=replacement-reason]').val(data.note)

                    initializeSelect2(
                        'js-timetable-trainer-id',
                        `/api/trainers/get-by-specialization?specialization_id=${data.activity_id}&trainer_id=${data.trainer_id}`,
                        trainer => trainer.full_name
                    )

                    modal.style.display = 'flex'
                })
            }

            $(info.el).tooltip({
                container: 'body',
                html: true,
                title: renderTimetablePopupContent(data),
                boundary: 'window',
                trigger : 'hover focus',
            })
        },

        events: '/api/timetable',
        displayEventTime: false,
    })

    calendar.render()

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }

    $('[data-modal=close]').on('click', function (event) {
        modal.style.display = 'none'
    })

    function renderTimetablePopupContent(data) {
        return `
            <ul>
                <li class="font-weight-bold">Активность</li>
                <li>${data.activity}</li>
                <li class="font-weight-bold">Группа</li>
                <li>${data.group}</li>
                <li class="font-weight-bold">Время занятия</li>
                <li>${data.title}</li>
                <li class="font-weight-bold">Тренер</li>
                <li>${data.trainer}</li>
            </ul>
        `
    }
}
