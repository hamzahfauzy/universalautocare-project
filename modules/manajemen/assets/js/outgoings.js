// var items = []
$('.add-item-button').click(function(){
    const selectedItem = {
        category: $('select[name=category]').find(':selected')[0],
        product: $('select[name=product]').find(':selected')[0],
        purchase: $('select[name=purchase]').find(':selected')[0],
    }

    if(!selectedItem.category.index || !selectedItem.product.index || (selectedItem.product.dataset.itemtype == 1 && !selectedItem.purchase.index))
    {
        alert('Tidak dapat menambahkan item karena ada field yang tidak dipilih')
        return
    }
    
    const selectedData = {
        category: sanitizeSelected(selectedItem.category.text),
        product: sanitizeSelected(selectedItem.product.text),
        purchase: sanitizeSelected(selectedItem.purchase.text),
    }

    // validate
    const validator = items.find(item => item.product == $('select[name=product]').val() && item.code == selectedData.purchase)
    if(validator){
        alert('Barang sudah ada dalam daftar')
        return
    }

    const data = {
        key:items.length+1,
        code: selectedData.purchase,
        name: selectedData.product,
        qty: 1,
        max_qty: selectedItem.purchase.index ? selectedItem.purchase.dataset.maxqty : -1,
        price: parseInt(selectedItem.purchase.index ? selectedItem.purchase.dataset.price : selectedItem.product.dataset.price),
        total_price: 0,
        unit: selectedItem.product.dataset.unit,
        category_name: selectedData.category,
        category: $('select[name=category]').val(),
        product: $('select[name=product]').val(),
        purchase: $('select[name=purchase]').val(),
    }

    data.total_price = data.price * data.qty
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][order_number]" value="${items.length+1}">
                <input type="hidden" name="items[${items.length}][item_id]" value="${data.product}">
                <input type="hidden" name="items[${items.length}][purchase_id]" value="${data.purchase}">
                <input type="hidden" name="items[${items.length}][price]" value="${data.price}">
                <input type="hidden" name="items[${items.length}][unit]" value="${data.unit}">
                ${items.length+1}
                </td>
                <td>${data.code}</td>
                <td>${data.category_name}</td>
                <td>${data.name}</td>
                <td>Rp. ${format_number(data.price)}</td>
                <td><input type="number" step=".1" class="form-control qty-input" min="0.1" ${data.max_qty > 0 ? "max='"+data.max_qty+"'" : ''} style="width:100px" name="items[${items.length}][outgoing_qty]" value="${data.qty}" data-key="${items.length+1}"></td>
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

    item.qty = parseFloat($(this).val())
    item.total_price = item.price * item.qty
    $('#total_price_'+key).html('Rp. ' + format_number(item.total_price))
    calculateTotalOrder()
})

$('select[name=category]').on('select2:selecting', function(e) {
    // retrieve product by category
    const category_id = e.params.args.data.id
    fetch('/manajemen/outgoings/load-form-item-options?category_id='+category_id).then(res => res.json())
    .then(res => {
        $('select[name=product]').html('<option value="" data-price="0" data-unit="PCS">- Pilih -</option>')
        
        res.data.products.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}" data-unit="${data.unit}" data-itemtype="${data.item_type}">${data.name}</option>`
            $('select[name=product]').append(newOption)
        })
    })
});

$('select[name=product]').on('select2:selecting', function(e) {
    // retrieve product by category
    const product_id = e.params.args.data.id
    fetch('/manajemen/purchases/load-item-by-product?product_id='+product_id).then(res => res.json())
    .then(res => {
        $('select[name=purchase]').html('<option value="" data-price="0" data-maxqty="0">- Pilih -</option>')
        
        res.data.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}" data-maxqty="${data.max_qty}">${data.code}</option>`
            $('select[name=purchase]').append(newOption)
        })
    })
});

$('select[name="trn_outgoings[order_id]"').on('select2:selecting', function(e) {
    const order_id = e.params.args.data.id
    fetch('/manajemen/outgoings/load-form-order-options?order_id='+order_id).then(res => res.json())
    .then(res => {
        $("#customer").html(res.data.customer.name+" - "+res.data.order.customer_police_number)
    })
});


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

    $('input[name="trn_outgoings[total_outgoing_items]"]').val(items.length)
}

function sanitizeSelected(value)
{
    return value.replace('- Pilih -','')
}

function format_number(value)
{
    return new Intl.NumberFormat('en-US').format(value)
}

function calculateTotalOrder()
{
    var totalOrder = 0
    var totalQty = 0
    items.forEach(item => {
        totalOrder += item.total_price
        totalQty += item.qty
    })

    $('input[name="trn_outgoings[total_outgoing_value]"]').val(format_number(totalOrder))

    if($('input[name="trn_outgoings[total_outgoing_qty]"]'))
    {
        $('input[name="trn_outgoings[total_outgoing_qty]"]').val(totalQty)
    }
}