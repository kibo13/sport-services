export const tag = {
    event(data) {
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
    },

    timetable(data) {
        return `
            <ul>
                <li>
                    <strong>Группа: </strong>
                    <span>${data.group}</span>
                </li>
                <li>
                    <strong>Категория: </strong>
                    <span>${data.category}</span>
                </li>
                <li>
                    <strong>Кабинет: </strong>
                    <span>${data.room}</span>
                </li>
                <li>
                    <strong>Время занятия: </strong>
                    <span>${data.title}</span>
                </li>
                <li>
                    <strong>Руководитель: </strong>
                    <span>${data.teacher}</span>
                </li>
            </ul>
        `
    }
}


