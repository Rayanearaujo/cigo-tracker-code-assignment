function loadAllOrders(successCallback, errorCallback) {
    $.ajax({
            url: '/index.php?r=orders/get-all',
            type: 'GET',
            success: function (response) {
                let resp = JSON.parse(response);
                successCallback(resp);
            },
            error: errorCallback
        }
    );
}

function loadOneOrder(orderId, successCallback, errorCallback) {
    $.ajax({
            url: '/index.php?r=orders/get-one',
            data: {'id': orderId},
            type: 'GET',
            success: function (response) {
                let resp = JSON.parse(response);
                successCallback(resp);
            },
            error: errorCallback
        }
    );
}

function createOrder(data, successCallback, errorCallback) {
    $.ajax({
        url: '/index.php?r=orders/create',
        type: 'POST',
        data: data,
        success: function (response) {
            let resp = JSON.parse(response);

            if (resp['status'] === 'ok') {
                successCallback(resp);
            } else {
                errorCallback(resp);
            }
        },
        error: function (e) {
            console.error(e);
        }
    });
}

function reloadOrderList(){
    $.pjax.reload({
        container: '#orders-list',
        timeout: 4000
    });
}