import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'

const events = document.getElementById('js-events')
const calendar = new Calendar(events, {
    locale: 'ru',
    firstDay: 1,
    editable: false,
    selectable: true,
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
            init: info.event.extendedProps.init
        }

        $(info.el).tooltip({
            container: 'body',
            html: true,
            title: renderEventPopupContent(data),
            boundary: 'window',
            trigger : 'hover focus',
        })
    },

    events: `/api/events`,
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
            <li class="font-weight-bold">Время проведения</li>
            <li>${data.init}</li>
        </ul>
    `
}
