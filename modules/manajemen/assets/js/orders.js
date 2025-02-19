// var items = []
$('.add-item-button').click(function(){
    const selectedItem = {
        category: $('select[name=category]').find(':selected')[0],
        service: $('select[name=service]').find(':selected')[0],
    }
    
    const selectedData = {
        category: sanitizeSelected(selectedItem.category.text),
        service: sanitizeSelected(selectedItem.service.text),
    }
    
    const data = {
        key:items.length+1,
        name: selectedData.service,
        qty: 1,
        price: parseInt(selectedItem.service.dataset.price),
        total_price: 0,
        unit: selectedItem.service.dataset.unit,
        category_name: selectedData.category,
        category: $('select[name=category]').val(),
        service: $('select[name=service]').val(),
    }

    data.total_price = data.price * data.qty
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][order_number]" value="${items.length+1}">
                <input type="hidden" name="items[${items.length}][service_id]" value="${data.service}">
                <input type="hidden" name="items[${items.length}][price]" value="${data.price}">
                <input type="hidden" name="items[${items.length}][unit]" value="${data.unit}">
                ${items.length+1}
                </td>
                <td>${data.category_name}</td>
                <td>${data.name}</td>
                <td>Rp. ${format_number(data.price)}</td>
                <td><input type="number" class="form-control qty-input" style="width:100px" name="items[${items.length}][qty]" value="${data.qty}" data-key="${items.length+1}"></td>
                <td>${data.unit}</td>
                <td id="total_price_${items.length+1}">Rp. ${format_number(data.total_price)}</td>
                <td><button class="btn btn-sm btn-danger remove-item-button" type="button" data-target="#item_${items.length+1}" data-key="${items.length+1}"><i class="fas fa-trash"></i></button></td>
                </tr>
                `
    $('.table-item tbody').append(row)
    items.push(data)

    alert('Item berhasil di tambahkan')

    calculateTotalOrder()

    refreshRow()
});

$(document.body).on('click', '.remove-item-button', function(){
    var target = $(this).data('target')
    var key = $(this).data('key')
    $(target).remove()
    const index = items.findIndex(item => item.key == key);
    if (index > -1) { // only splice array when item is found
        items.splice(index, 1); // 2nd parameter means remove one item only
    }

    calculateTotalOrder()
    refreshRow()
})

$(document.body).on('change', '.qty-input', function(){
    var key = $(this).data('key')
    const index = items.findIndex(item => item.key == key);
    const item = items[index]

    item.qty = parseInt($(this).val())
    item.total_price = item.price * item.qty
    $('#total_price_'+key).html('Rp. ' + format_number(item.total_price))
    calculateTotalOrder()
})

$('select[name=category]').on('select2:selecting', function(e) {
    const category_id = e.params.args.data.id
    fetch('/manajemen/orders/load-form-item-options?category_id='+category_id).then(res => res.json())
    .then(res => {
        $('select[name=service]').html('<option value="" data-price="0" data-unit="PCS">- Pilih -</option>')
        
        res.data.services.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}" data-unit="${data.unit}">${data.name}</option>`
            $('select[name=service]').append(newOption)
        })
    })
});

$('#customer').on('select2:selecting', function(e) {
    const customer_id = e.params.args.data.id
    fetch('/manajemen/orders/load-form-customer-options?customer_id='+customer_id).then(res => res.json())
    .then(res => {
        $('input[name=phone]').val(res.data.customer.phone)
    })
});

$("#total_item_value").change(function(e) {
    calculateTotalOrder()
})


function refreshRow()
{
    if(items.length)
    {
        $('#empty_item').hide()
    }
    else
    {
        $('#empty_item').show()
    }
}

function sanitizeSelected(value)
{
    return value.replace('- Pilih -','')
}

function format_number(value)
{
    return new Intl.NumberFormat().format(value)
}

function calculateTotalOrder()
{
    var totalServiceValue = 0
    items.forEach(item => {
        totalServiceValue += item.total_price
    })

    $('input[name="trn_orders[total_service_value]"]').val(format_number(totalServiceValue))
    $('input[name="trn_orders[total_value]"]').val(format_number(totalServiceValue+parseInt($("#total_item_value").val())))
}