window.reportData = $('.datatable').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            data.filter = {}
            data.filterByDate = {}
            $('.filters').each(function(){
                const filter = $(this)
                if(filter.attr('name') == 'start_date' || filter.attr('name') == 'end_date' || filter.val() == '' || filter.val() == '- Pilih -')
                {
                    if(filter.attr('name') == 'start_date' || filter.attr('name') == 'end_date')
                    {
                        data.filterByDate[filter.attr('name')] = filter.val()
                    }
                    return
                }

                data.filter[filter.attr('name')] = filter.val()
            })
            if(!Object.keys(data.filterByDate).length)
            {
                delete data.filterByDate
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }
            
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

function downloadReport()
{
    var data = {}
    data.filter = {}
    data.filterByDate = {}
    $('.filters').each(function(){
        const filter = $(this)
        if(filter.attr('name') == 'start_date' || filter.attr('name') == 'end_date' || filter.val() == '' || filter.val() == '- Pilih -')
        {
            if(filter.attr('name') == 'start_date' || filter.attr('name') == 'end_date')
            {
                data.filterByDate[filter.attr('name')] = filter.val()
            }
            return
        }

        data.filter[filter.attr('name')] = filter.val()
    })
    if(!Object.keys(data.filterByDate).length)
    {
        delete data.filterByDate
    }

    if(!Object.keys(data.filter).length)
    {
        delete data.filter
    }
    
    var search = window.reportData.search()
    if(search)
    {
        data.search = search
    }
    const url = Qs.stringify(data, { encode: false })

    window.location = location.href + "/download?"+url
}

$('select').select2();