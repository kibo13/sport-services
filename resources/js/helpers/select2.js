export function initializeSelect2(elementId, url, displayText) {
    $('#' + elementId).select2({
        ajax: {
            url: url,
            dataType: 'json',
            data: function (params) {
                let query = {
                    search: params.term,
                    type: 'public'
                }

                // Проверяем, есть ли текст в поле ввода
                if ($.trim(params.term) !== '') {
                    return query
                }

                // Если нет текста, возвращаем null, чтобы отменить запрос
                return null
            },
            processResults: function(data) {
                if (typeof data === 'object') {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: displayText(item)
                            }
                        })
                    }
                } else {
                    console.error('Unexpected data type received:', typeof data)
                    return { results: [] }
                }
            }
        }
    })
}
