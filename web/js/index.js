function objectifyForm(formArray) {//serialize data function
    const returnArray = {};
    for (let i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

/***** Avoid page reload *****/
$('#addOrderFormBtn').click(function (e) {
    e.stopPropagation();
});

/***** Create a new order *****/

$('#addOrderForm').submit(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    let data = objectifyForm($('#addOrderForm').serializeArray());

    getLocation(data,
        (response) => {
            let latitude = response.results[0].location['lat'];
            let longitude = response.results[0].location['lng'];
            data['latitude'] = latitude;
            data['longitude'] = longitude;

            createOrder(data, function (response) {
                let orderId = response['order_id'];
                refreshOrderStatusById(orderId);
                removePreviewMarker();
                reloadOrderList();
                $.alert({
                    title: 'Create Order',
                    content: 'Order created successfully!',
                    backgroundDismiss: true,
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                        okay: function () {
                        }
                    }
                });
            }, function () {
                $.alert({
                    title: 'Create Order',
                    content: 'Failed to create the order.',
                    backgroundDismiss: true,
                    type: 'red',
                    typeAnimated: true
                });
            });
        },
        (_) => {
            $.alert({
                title: 'Create Order',
                content: 'Could not find your location, please try again.',
                backgroundDismiss: true,
                type: 'red',
                typeAnimated: true
            });
        });

    return false;
});

$(".orders-btn").click(function (e) {
    e.stopPropagation();
});

/***** Update an order status *****/
$(document).on('change', ".orders-btn", function () {
    let newOrderStatus = $(this).val();
    let orderId = $(this).parents('tr').data('key');
    $.ajax({
        url: '/index.php?r=orders/update&id=' + orderId,
        type: 'POST',
        data: {"Order": {"order_status": newOrderStatus, "id": orderId}},
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp['status'] === 'ok') {
                refreshOrderStatusById(orderId);
                reloadOrderList();
            } else {
                $.alert({
                    title: 'Update Order Status',
                    content: 'Failed to update the order.',
                    backgroundDismiss: true,
                    type: 'red',
                    typeAnimated: true
                });
            }
        },
        error: function () {
            $.alert({
                title: 'Update Order Status',
                content: 'Failed to update the order.',
                backgroundDismiss: true,
                type: 'red',
                typeAnimated: true
            });
        }
    });
});

/***** Delete an order *****/
$(document).on('click', ".orders-delete-btn", function (e) {
    e.preventDefault();
    let orderId = $(this).parents('tr').data('key');
    $.confirm({
        title: 'Delete Order',
        content: 'Are you sure you want to delete this order?',
        theme: 'supervan',
        backgroundDismiss: true,
        buttons: {
            confirm: function () {
                $.ajax({
                    url: '/index.php?r=orders/delete&id=' + orderId,
                    type: 'POST',
                    data: {"Order": {"id": orderId}},
                    success: function (response) {
                        let resp = JSON.parse(response);
                        if (resp['status'] === 'ok') {
                            reloadOrderList();
                            removeMarkerByOrderId(orderId);
                        } else {
                            $.alert({
                                title: 'Delete Order',
                                content: 'Failed to delete the order.',
                                backgroundDismiss: true,
                                type: 'red',
                                typeAnimated: true
                            });
                        }
                    },
                    error: function () {
                        $.alert({
                            title: 'Delete Order',
                            content: 'Failed to delete the order.',
                            backgroundDismiss: true,
                            type: 'red',
                            typeAnimated: true
                        });
                    }
                });
            },
            cancel: function () {

            }
        }
    });
    e.stopPropagation();
});

$('#reset-add-button').click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    $('#addOrderForm')[0].reset();
    removePreviewMarker();
});


$('.fa-calendar-alt').click(function (e) {
    $('#scheduled_date').focus();
});