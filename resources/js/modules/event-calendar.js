import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
// import { tag } from './tooltip'
// import { compare } from '../custom/comparison'

const director = document.getElementById('is_director').value
const modal    = document.getElementById('bk-event-modal')
const endField = document.getElementById('field-end')
const events   = document.getElementById('events')
const calendar = new Calendar(events, {
    locale: 'ru',
    firstDay: 1,
    editable: false,
    selectable: director ? true : false,
    initialView: 'dayGridMonth',
    plugins: [
        interactionPlugin,
        dayGridPlugin,
        timeGridPlugin,
        listPlugin
    ],

    headerToolbar: {
        left: 'prev,next today',
        right: 'title',
        // right: 'dayGridMonth,timeGridWeek,listWeek',
    },

    buttonText: {
        today:    'Сегодня',
        month:    'Месяц',
        week:     'Неделя',
        day:      'День',
        list:     'Список'
    },

    eventDidMount(info) {
        const data = {
            title: info.event.title,
            type: info.event.extendedProps.type,
            trainer: info.event.extendedProps.trainer,
            place: info.event.extendedProps.place,
        }

        // if (director) {
        //     $(info.el).on('click', function (event) {
        //         window.location.href = `${window.location.origin}/events/${data.event_id}/edit`
        //     })
        // }

        $(info.el).tooltip({
            container: 'body',
            html: true,
            title: renderEventPopupContent(data),
            boundary: 'window',
            trigger : 'hover focus',
        })
    },

    events: `/api/events`,

    // select(info) {
    //     let from = moment(info.endStr, 'YYYY-MM-DD')
    //     let till = moment(info.startStr, 'YYYY-MM-DD')
    //     let days = moment.duration(from.diff(till)).asDays()
    //
    //     endField.style.display = days > 1 ? 'block' : 'none'
    //
    //     $('[data-modal=from]').val(info.startStr)
    //     $('[data-modal=till]').val(info.endStr)
    //
    //     modal.style.display = 'flex'
    // }
})

calendar.render()

function renderEventPopupContent(data) {
    return `
        <ul>
            <li class="font-weight-bold">Событие</li>
            <li>${data.title}</li>
            <li class="font-weight-bold">Вид</li>
            <li>${data.type}</li>
            <li class="font-weight-bold">Тренер</li>
            <li>${data.trainer}</li>
            <li class="font-weight-bold">Место проведения</li>
            <li>${data.place}</li>
        </ul>
    `
}

// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.display = 'none'
//     }
// }

// $('[data-modal=submit]').on('click', function (event) {
//     // check: compare dates
//     let from = $('[data-modal=from]').val()
//     let till = $('[data-modal=till]').val()
//
//     compare.dates(from, till, event)
// })

// $('[data-modal=close]').on('click', function (event) {
//     modal.style.display = 'none'
// })
