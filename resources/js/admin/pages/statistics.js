import { compare } from '../custom/comparison'

const statisticIndex = document.getElementById('statistic-index')

if (statisticIndex) {
    $('#stat-run').on('click', function (event) {
        let from = $('#stat-from').val()
        let till = $('#stat-till').val()

        compare.dates(from, till, event)
    })
}
