
function loadFile(event)
{
    var output = document.getElementById('output');
    output.removeAttribute('class');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
}

//=================================================category edit
$(document).on('click', '.category-edit-btn', function () {
    var id = $(this).attr('data-id');

    $.ajax({
        type: "GET",
        url: baseURL+"/category/edit/",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editCategoryName').val(response.name);
            $('#editCategoryId').val(response.id);
            $('#editCategoryDescription').text(response.description);
            $('#editCategoryImage').attr('src', response.image);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editCategoryModal').modal('show');
        }
    });
});
//=================================================sub category edit
$(document).on('click', '.sub-category-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/sub-category/edit/",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editCategoryId').val(response.category_id);
            $('#editSubCategoryName').val(response.name);
            $('#editSubCategoryId').val(response.id);
            $('#editSubCategoryDescription').text(response.description);
            $('#editSubCategoryImage').attr('src', response.image);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editSubCategoryModal').modal('show');
        }
    });
});

//=================================================brand edit
$(document).on('click', '.brand-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/brand/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editBrandName').val(response.name);
            $('#editBrandId').val(response.id);
            $('#editBrandDescription').text(response.description);
            $('#editBrandImage').attr('src', response.image);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editBrandModal').modal('show');
        }
    });
});

//=================================================unit edit
$(document).on('click', '.unit-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/unit/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editUnitName').val(response.name);
            $('#editUnitCode').val(response.code);
            $('#editUnitId').val(response.id);
            $('#editUnitDescription').text(response.description);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editUnitModal').modal('show');
        }
    });
});

//=================================================color edit
$(document).on('click', '.color-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/color/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editColorName').val(response.name);
            $('#editColorCode').val(response.code);
            $('#editColorId').val(response.id);
            $('#editColorDescription').text(response.description);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editColorModal').modal('show');
        }
    });
});

//=================================================size edit
$(document).on('click', '.size-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/size/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editSizeName').val(response.name);
            $('#editSizeCode').val(response.code);
            $('#editSizeId').val(response.id);
            $('#editSizeDescription').text(response.description);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editSizeModal').modal('show');
        }
    });
});

//=================================================size edit
$(document).on('click', '.store-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/store/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editStoreName').val(response.name);
            $('#editStoreCode').val(response.code);
            $('#editStoreContactPerson').val(response.contact_person);
            $('#editStoreEmail').val(response.email);
            $('#editStoreMobile').val(response.mobile);
            $('#editStoreId').val(response.id);
            $('#editStoreAddress').text(response.address);
            $('#editStoreImage').attr('src', response.logo);
            if(response.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editStoreModal').modal('show');
        }
    });
});

//=================================================item edit
$(document).on('click', '.item-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/item/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editCategoryId').val(response.item.category_id);
            $('#editSubCategoryId').val(response.item.sub_category_id);
            $('#editBrandId').val(response.item.brand_id);
            $('#editUnitId').val(response.item.unit_id);
            var colorOprion = '';
            var check = true;
            var demo = 1;
            $.each(response.all_color, function (key, value) {
                $.each(response.colors, function (key1, value1) {
                    if(value1.id == value.id)
                    {
                        colorOprion += '<option value="'+value.id+'"  selected> '+value.name+' </option>';
                        check   = false;
                        demo    = 2;
                    }
                    else
                    {
                        if (demo == 1)
                        {
                            check = true;
                        }
                    }
                });
                demo = 1;
                if (check)
                {
                    colorOprion += '<option value="'+value.id+'"> '+value.name+' </option>';

                }
            });

            //console.log(colorOprion);

            $('#editColorId').empty();
            $('#editColorId').append(colorOprion);

            var sizeOprion = '';
            var sizeCheck = true;
            var sizeDemo = 1;
            $.each(response.all_size, function (key, value) {
                $.each(response.sizes, function (key1, value1) {
                    if (value.id == value1.id)
                    {
                        sizeOprion += '<option value="'+value.id+'" selected> '+value.name+' </option>';
                        sizeCheck = false;
                        sizeDemo = 2;
                    }
                    else
                    {
                        if (sizeDemo == 1)
                        {
                            sizeCheck = true
                        }
                    }
                });
                sizeDemo = 1;
                if (sizeCheck)
                {
                    sizeOprion += '<option value="'+value.id+'"> '+value.name+' </option>';
                }
            });

            $('#editSizeId').empty();
            $('#editSizeId').append(sizeOprion);

            $('#editItemName').val(response.item.name);
            $('#editItemId').val(response.item.id);
            $('#editITemCode').val(response.item.code);
            $('#editITemModel').val(response.item.model);
            $('#editItemDescription').val(response.item.short_description);
            $('#editItemImage').attr('src', response.item.image);
            if(response.item.status == 1)
            {
                $('#statusPublished').prop('checked', 'true');
            }
            else
            {
                $('#statusUnpublished').prop('checked', 'true');
            }
            $('#editItemModal').modal('show');
        }
    });
});

//============================================item price add
var addITemPriceIndex = 1;
$(document).on('click', '#addItemPriceBtn', function () {

    $.ajax({
        type: "GET",
        url: baseURL+"/item-price/get-all-size-color",
        dataType: "JSON",
        success: function (response) {
            var tr = '';
            tr += '<tr>';
            tr += '<td>';
            tr += '<select class="form-control item_price" name="item['+addITemPriceIndex+'][item_id]" required data-id="'+addITemPriceIndex+'">';
            tr += '<option value="" disabled selected> -- Select Item -- </option>';
            $.each(response.items, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td>';
            tr += '<select class="select2 form-control select2-multiple" multiple="multiple" data-toggle="select2" data-placeholder="Item Color" name="item['+addITemPriceIndex+'][color][]" required id="colorId'+addITemPriceIndex+'">';
            $.each(response.colors, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td>';
            tr += '<select class="select2 form-control select2-multiple" multiple="multiple" data-toggle="select2" data-placeholder="Item Size" name="item['+addITemPriceIndex+'][size][]" required id="sizeId'+addITemPriceIndex+'">';
            $.each(response.sizes, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td>';
            tr += '<input type="number" class="form-control" name="item['+addITemPriceIndex+'][price]" min="1"/>';
            tr += '</td>';

            tr += '<td>';
            tr += '<button type="button" class="btn btn-danger remove-item-price-btn"> - </button>';
            tr += '</td>';

            tr += '</tr>';
            addITemPriceIndex++;
            $('#itemPriceTBody').append(tr);
            $('.select2').select2();
        }
    });
});


$(document).on('click', '.remove-item-price-btn', function () {
    $(this).closest('tr').remove();
});

$(document).on('change', '.item_price', function () {
    var id      = $(this).val();
    var dataId  = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/item-price/get-item-size-color",
        data:{'id': id},
        dataType: "JSON",
        success: function (response) {
            var optionColor = '';
            $.each(response.colors, function (key, value) {
                optionColor += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            $('#colorId'+dataId).empty();
            $('#colorId'+dataId).append(optionColor);

            var optionSize = '';
            $.each(response.sizes, function (key, value) {
                optionSize += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            $('#sizeId'+dataId).empty();
            $('#sizeId'+dataId).append(optionSize);
        }
    });
});

//===================================item-price-edit

$(document).on('click', '.item-price-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/item-price/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editItemPriceItemName').val(response.item_name);
            $('#editItemPriceItemId').val(response.item_id);
            $('#editItemPriceColorName').val(response.color_name);
            $('#editItemPriceColorId').val(response.color_id);
            $('#editItemPriceSizeName').val(response.size_name);
            $('#editItemPriceSizeId').val(response.size_id);
            $('#editItemPrice').val(response.price);
            $('#editItemPriceModal').modal('show');
        }
    });
});
//====================================================supplier-edit-form
$(document).on('click', '.supplier-edit-btn', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/supplier/edit",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#editSupplierName').val(response.name);
            $('#editSupplierId').val(response.id);
            $('#editSupplierCode').val(response.code);
            $('#editSupplierEmail').val(response.email);
            $('#editSupplierMobile').val(response.mobile);
            $('#editSupplierAccNo').val(response.acc_number);
            $('#editSupplierAddress').val(response.address);
            $('#editSupplierImage').attr('src', response.image);
            $('#editSupplierModal').modal('show');
        }
    });
});

//============================================item stock add
var addITemStockIndex = 1000;
$(document).on('click', '#addItemStockBtn', function () {
    alert('ok');

    $.ajax({
        type: "GET",
        url: baseURL+"/item-price/get-all-size-color",
        dataType: "JSON",
        success: function (response) {
            var tr = '';
            tr += '<tr>';
            tr += '<td class="p-1">';
            tr += '<select class="form-control item_price" name="item['+addITemStockIndex+'][item_id]" required data-id="'+addITemStockIndex+'">';
            tr += '<option value="" disabled selected> -- Select Item -- </option>';
            $.each(response.items, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td class="p-1">';
            tr += '<select class="select2 form-control select2-multiple" multiple="multiple" data-toggle="select2" data-placeholder="Item Color" name="item['+addITemStockIndex+'][color][]" required id="colorId'+addITemStockIndex+'">';
            $.each(response.colors, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td class="p-1">';
            tr += '<select class="select2 form-control select2-multiple" multiple="multiple" data-toggle="select2" data-placeholder="Item Size" name="item['+addITemStockIndex+'][size][]" required id="sizeId'+addITemStockIndex+'">';
            $.each(response.sizes, function (key, value) {
                tr += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            tr += '</select>';
            tr += '</td>';

            tr += '<td class="p-1">';
            tr += '<input type="text" class="form-control" name="item['+addITemStockIndex+'][price]"/>';
            tr += '</td>';

            tr += '<td class="p-1">';
            tr += '<input type="text" class="form-control" name="item['+addITemStockIndex+'][qty]"/>';
            tr += '</td>';

            tr += '<td class="p-1">';
            tr += '<button type="button" class="btn btn-danger remove-item-stock-btn"> - </button>';
            tr += '</td>';

            tr += '</tr>';
            addITemStockIndex++;
            $('#itemStockTBody').append(tr);
            $('.select2').select2();
        }
    });
});

$(document).on('click', '.remove-item-stock-btn', function () {
    $(this).closest('tr').remove();
});

//=================================================view stock detail========================


$(document).on('click', '.view-stock-modal', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/stock/detail",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            $('#stockDetailTbody').empty();
            $('#stockInDate').text(response.stock_in_date);
            $('#storeName').text(response.store.name + ' - '+ response.store.mobile);
            $('#note').text(response.note);

            var tr = '';
            $.each(response.details, function (key, value) {
                tr += '<tr>';
                    tr += '<td>'+ ++key +'</td>';
                    tr += '<td>'+value.item_name+'</td>';
                    tr += '<td>'+value.color_name+'</td>';
                    tr += '<td>'+value.size_name+'</td>';
                    tr += '<td>'+value.price+'</td>';
                    tr += '<td>'+value.qty+'</td>';
                tr += '</tr>';
            });
            $('#stockDetailTbody').append(tr);
            $('#viewStockModal').modal('show');
        }
    });
});



//=================================================transfer stock detail========================


$(document).on('change', '#sendStore', function () {
    var sendStoreId = $(this).val();
    $.ajax({
        type: "GET",
        url: baseURL+"/stock/get-all-stock-chalan",
        data:{id: sendStoreId},
        dataType: "JSON",
        success: function (response) {
            $('#transferChalanNo').empty();
            var option = '';
            option += '<option value="" disabled selected> -- Select Chalan No -- </option>';
            $.each(response, function (key, value) {
                option += '<option value="'+value.chalan_no+'"> '+value.chalan_no+' </option>';
            });
            $('#transferChalanNo').append(option);
        }
    });
});


$(document).on('change', '#transferChalanNo', function () {
    var chalanNo = $(this).val();
    $.ajax({
        type: "GET",
        url: baseURL+"/stock/get-stock-info-by-chalan",
        data:{chalan_no: chalanNo},
        dataType: "JSON",
        success: function (response) {
            //console.log(response);
            $('#transferStockTBody').empty();
            var tr = '';
            $.each(response, function (key, value) {
                tr += '<tr>';
                tr += '<td>'+value.item+'<input type="hidden" name="stock['+key+'][item_id]" value=" '+value.item_id+' " class="form-control"/></td>';
                tr += '<td>'+value.color+'<input type="hidden" name="stock['+key+'][color_id]" value=" '+value.color_id+' " class="form-control"/></td>';
                tr += '<td>'+value.size+'<input type="hidden" name="stock['+key+'][size_id]" value=" '+value.size_id+' " class="form-control"/></td>';
                tr += '<td>'+value.price+'<input type="hidden" name="stock['+key+'][price]" value=" '+value.price+' " class="form-control"/></td>';
                tr += '<td>'+value.qty+'</td>';
                tr += '<td><input type="number" name="stock['+key+'][qty]" class="form-control"/></td>';
                tr += '</tr>';
            });
            $('#transferStockTBody').append(tr);
        }
    });
});


$(document).on('click', '.view-stock-transfer-modal', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/stock/transfer-detail",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            // console.log(response);
            $('#stockTransferDetailTbody').empty();
            $('#stockTransferDate').text(response.transfer_date);
            $('#sendStoreInfo').text(response.send_store_info);
            $('#chalanNo').text(response.chalan);
            $('#receiveStoreInfo').text(response.receive_store_info);
            $('#note').text(response.note);

            var tr = '';
            $.each(response.details, function (key, value) {
                tr += '<tr>';
                tr += '<td>'+ ++key +'</td>';
                tr += '<td>'+value.item_name+'</td>';
                tr += '<td>'+value.color_name+'</td>';
                tr += '<td>'+value.size_name+'</td>';
                tr += '<td>'+value.price+'</td>';
                tr += '<td>'+value.qty+'</td>';
                tr += '</tr>';
            });
            $('#stockTransferDetailTbody').append(tr);
            $('#viewTransferStockModal').modal('show');
        }
    });
});

//=================================================sales register========================

var salesItemIndex = 1;
$(document).on('click', '#itemSearchBtn', function () {
    var searchText = $('#searchItem').val();
    $.ajax({
        type: "GET",
        url: baseURL+"/sales/get-search-item",
        data:{search_text: searchText},
        dataType: "JSON",
        success: function (response) {
            //console.log(response);
            var check = true;
            if (response.success == true)
             {
                 $.each($('.sales-item'), function (key, value) {
                     if (value.value == response.item.name+'-'+response.item.code+'-'+response.item.color+ '-'+response.item.size)
                     {
                         $('#searchItem').val('');
                         $('#searchItem').attr('placeholder', 'Search Item...');
                         alert('Item already exists');
                         check = false;
                     }
                 });

                 if (check == true)
                 {
                     var salesItemTBody = $('#salesItemTBody');
                     var tr = '';
                     tr += '<tr>';
                     tr += '<td>'+response.item.name+'-'+response.item.code+'-'+response.item.color+ '-'+response.item.size+'<input type="hidden" name="item['+salesItemIndex+'][name]" class="sales-item" value="'+response.item.name+'-'+response.item.code+'-'+response.item.color+ '-'+response.item.size+'"></td>';
                     tr += '<td id="price'+salesItemIndex+'">'+response.item.price+'<input type="hidden" name="item['+salesItemIndex+'][price]" value="'+response.item.price+'"/></td>';
                     tr += '<td><input type="number" value="1" name="item['+salesItemIndex+'][qty]" data-id="'+salesItemIndex+'" min="1" class="form-control sales-item-qty"/></td>';
                     tr += '<td id="total'+salesItemIndex+'" class="sales-item-total">'+response.item.price * 1 +'</td>';
                     tr += '<td><button type="button" class="btn btn-danger delete_sales_item"><i class="mdi mdi-delete"></i></button></td>';
                     tr += '</tr>';
                     salesItemTBody.append(tr);
                     $('#searchItem').val('');
                     $('#searchItem').attr('placeholder', 'Search Item...');
                     updateTotalSalesPrice();
                     updateTotalBill();
                     salesItemIndex++;
                 }
             }
             else
             {
                 $('#searchItem').val('');
                 $('#searchItem').attr('placeholder', 'Search Item...');
                 alert('Sorry... Item can not found. Please try again.');
             }
        }
    });
});

function updateTotalSalesPrice()
{
    var sum = 0;
    $.each($('.sales-item-total'), function (key, value) {
        sum = sum + Number(value.innerHTML);
    });
    var discountPercent = $('#discountSalesTotalPrice').val();
    var discountAmount  = Math.round(((discountPercent*sum)/100));
    var totalPrice = sum - discountAmount;
    $('#salesTotalPrice').val(totalPrice);
}

function updateTotalBill()
{
    var sum = Number($('#salesTotalPrice').val());
    var taxPercent = $('#salesTaxAmount').val();
    var taxAmount = Math.round(((sum * taxPercent)/100));
    var tax = Number(taxAmount);
    var totalPayable = sum + tax;
    $('#salesTotalBill').val(totalPayable);
}

$(document).on('blur', '.sales-item-qty', function () {
    var qty = $(this).val();
    var dataId = $(this).attr('data-id');
    var price = $('#price'+dataId).text();
    var total = qty * price;
    $('#total'+dataId).text(total);
    updateTotalSalesPrice();
    updateTotalBill();
});

$(document).on('blur', '#discountSalesTotalPrice', function () {
    updateTotalSalesPrice();
    updateTotalBill();
});

$(document).on('blur', '#salesTaxAmount', function () {
    updateTotalSalesPrice();
    updateTotalBill();
});

$(document).on('blur', '#salesTotalReceiveAmount', function () {
    var paidAmount      = $(this).val();
    var salesTotalBill  = $('#salesTotalBill').val();
    var returnAmount    = salesTotalBill - paidAmount;
    $('#salesTotalReturnAmount').val(Math.abs(returnAmount));
});

$(document).on('click', '.delete_sales_item', function () {
    $(this).closest('tr').remove();
    updateTotalSalesPrice();
    updateTotalBill();
});


$(document).on('click', '#salesCustomerSaveBtn', function () {
    event.preventDefault();
    var form = $('#salesSaveCustomerForm')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        url: baseURL+"/customer/sales-create",
        data: data,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (response) {
            $('#addCustomerModal').modal('hide');
            $('#customerSelect2').select2({
                tags: true,
                data: response.customers
            });
        }
    });
});


$(document).on('submit', '#salesPreviewForm', function () {
    var customerSelect2Value = $('#customerSelect2').val();
    if (customerSelect2Value == null)
    {
        alert('Please select customer name');
        return false;
    }
});


//=================================================view purchase detail========================


$(document).on('click', '.view-purchase-modal', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        type: "GET",
        url: baseURL+"/purchase/detail",
        data:{id: id},
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            $('#purchaseDetailTbody').empty();
            $('#purchaseDate').text(response.purchase_date);
            $('#supplierName').text(response.supplier.name + ' - '+ response.supplier.mobile);
            $('#chalanNo').text(response.chalan_no);
            $('#note').text(response.note);
            $('#paymentType').text(response.payment_type);
            $('#currency').text(response.currency);
            $('#discount').text(response.discount);
            $('#tax').text(response.tax);

            var tr = '';
            $.each(response.details, function (key, value) {
                tr += '<tr>';
                tr += '<td>'+ ++key +'</td>';
                tr += '<td>'+value.item_name+'</td>';
                tr += '<td>'+value.color_name+'</td>';
                tr += '<td>'+value.size_name+'</td>';
                tr += '<td>'+value.price+'</td>';
                tr += '<td>'+value.qty+'</td>';
                tr += '</tr>';
            });
            $('#purchaseDetailTbody').append(tr);
            $('#viewPurchaseModal').modal('show');
        }
    });
});
