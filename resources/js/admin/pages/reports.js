import { compare } from '../custom/comparison'
const reportIndex = document.getElementById('report-index')

if (reportIndex) {
    const menu    = document.getElementById('report-menu')
    const reports = document.getElementsByClassName('js-report-form')

    $(menu).on('change', function (event) {
        let reportName = event.target.options[menu.selectedIndex].value

        for (let report of reports) {
            reportName == report.id
                ? report.classList.remove('d-none')
                : report.classList.add('d-none')
        }
    })

    for (let report of reports) {
        $(`#${report.id} button`).on('click', function (event) {

            let from = $(`#${report.id} #report-from`).val()
            let till = $(`#${report.id} #report-till`).val()

            compare.dates(from, till, event)
        })
    }
}
