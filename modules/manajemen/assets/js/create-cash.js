$('select[name="trn_cash[reference_number]"]').change(function(){
    const selected = $(this).val()

    if(!selected) return

    const urls = {'PENERIMAAN KAS': '/manajemen/orders/load-by-code', 'PENGELUARAN KAS': '/manajemen/purchases/load-by-code', 'BIAYA KAS':'/manajemen/get-master-cash-by-id'}
    fetch(urls[window.cash_group] + '?code=' + selected)
        .then(res => res.json())
        .then(res => {
            if(window.cash_group == 'PENERIMAAN KAS')
            {
                loadPenerimaan(res.data)
            }
            if(window.cash_group == 'PENGELUARAN KAS')
            {
                loadPengeluaran(res.data)
            }
            if(window.cash_group == 'BIAYA KAS')
            {
                loadBiaya(res.data)
            }
        })
})

function loadPenerimaan(data)
{
    $('input[name="trn_cash[reference_date]"]').val(data.date)
    $('input[name="trn_cash[reference_name]"]').val(data.customer_name)
    $('input[name="trn_cash[police_number_reference]"]').val(data.customer_police_number)
    $('input[name="trn_cash[total_value]"]').val(format_number(data.total_value))
}

function loadPengeluaran(data)
{
    $('input[name="trn_cash[reference_date]"]').val(data.date)
    $('input[name="trn_cash[reference_name]"]').val(data.supplier_name)
    $('input[name="trn_cash[total_value]"]').val(format_number(data.total_value))
}

function loadBiaya(data)
{

}

function format_number(value)
{
    return new Intl.NumberFormat().format(value)
}

$('input[name="trn_cash[total_payment]"], input[name="trn_cash[discount]"]').change(function(){
    calculateTotalCash()
})

function calculateTotalCash()
{
    const val1 = $('input[name="trn_cash[cash_total]"]').val()
    const val2 = $('input[name="trn_cash[discount]"]').val()
    const total = parseInt(val1.replace(',','')) + parseInt(val2.replace(',',''))

    $('input[name="trn_cash[total_payment]"]').val(isNaN(total) ? 0 : format_number(total))
}