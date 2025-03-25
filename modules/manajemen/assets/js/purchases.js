// var items = []
$('.add-item-button').click(async function(){
    var product = $('select[name=product]').find(':selected')[0]
    var product_id = $('select[name=product]').val()
    if($('select[name=product]').val() == -1)
    {
        const formData = new FormData;
        formData.append('_token', document.querySelector('meta[name=csrf_token]').content)
        formData.append('category_id', $('select[name=category]').val())
        formData.append('name', $('#product_name').val())
        formData.append('unit', $('#product_unit').val())
        formData.append('price', 0)
        const request = await fetch('/manajemen/products/create', {
            method: 'POST',
            body: formData
        })

        const response = await request.json()
        product = {
            text: response.data.name,
            dataset: {
                unit: response.data.unit,
                price : response.data.price
            }
        }
        product_id = response.data.id
    }

    const selectedItem = {
        category: $('select[name=category]').find(':selected')[0],
        product: product,
    }
    
    const selectedData = {
        category: sanitizeSelected(selectedItem.category.text),
        product: sanitizeSelected(selectedItem.product.text),
    }

    // validate
    const validator = items.find(item => item.product == product_id)
    if(validator){
        alert('Barang sudah ada dalam daftar')
        return
    }
    
    const data = {
        key:items.length+1,
        name: selectedData.product,
        qty: 1,
        price: parseInt(selectedItem.product.dataset.price),
        total_price: 0,
        unit: selectedItem.product.dataset.unit,
        category_name: selectedData.category,
        category: $('select[name=category]').val(),
        product: product_id,
    }

    data.total_price = data.price * data.qty
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][order_number]" value="${items.length+1}">
                <input type="hidden" name="items[${items.length}][item_id]" value="${data.product}">
                <input type="hidden" name="items[${items.length}][unit]" value="${data.unit}">
                ${items.length+1}
                </td>
                <td>${data.category_name}</td>
                <td>${data.name}</td>
                <td><input type="tel" class="form-control qty-input-price" data-type="currency" style="width:100px" name="items[${items.length}][price]" value="${data.price}" data-key="${items.length+1}"></td>
                <td><input type="number" step=".1" class="form-control qty-input" style="width:100px" name="items[${items.length}][total_qty]" value="${data.qty}" data-key="${items.length+1}"></td>
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

    refreshCurrencyField()
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

$(document.body).on('change', '.qty-input-price', function(){
    var key = $(this).data('key')
    const index = items.findIndex(item => item.key == key);
    const item = items[index]

    item.price = parseInt($(this).val())
    item.total_price = item.price * item.qty
    $('#total_price_'+key).html('Rp. ' + format_number(item.total_price))
    calculateTotalOrder()
})

$('select[name=category]').on('select2:selecting', function(e) {
    // retrieve product by category
    const category_id = e.params.args.data.id
    fetch('/manajemen/purchases/load-form-item-options?category_id='+category_id).then(res => res.json())
    .then(res => {
        $('select[name=product]').html('<option value="" data-price="0" data-unit="PCS">- Pilih -</option><option value="-1" data-price="0" data-unit="PCS">- Buat Produk Baru -</option>')
        
        res.data.products.forEach(data => {
            var newOption = `<option value="${data.id}" data-price="${data.price}" data-unit="${data.unit}">${data.name}</option>`
            $('select[name=product]').append(newOption)
        })
    })
});

$('select[name=product]').on('select2:selecting', function(e) {
    const product_id = e.params.args.data.id
    if(product_id == -1)
    {
        $('#new-product').show()
    }
    else
    {
        $('#new-product').hide()
    }
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

    $('input[name="trn_purchases[total_item]"]').val(items.length)
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

    $('input[name="trn_purchases[total_value]"]').val(format_number(totalOrder))

    if($('input[name="trn_purchases[total_qty]"]'))
    {
        $('input[name="trn_purchases[total_qty]"]').val(totalQty)
    }
}