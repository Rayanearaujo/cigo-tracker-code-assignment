const myMap = L.map('map-id').setView([45.5449878, -73.6625625], 11);
const accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
const icons = {
    'pending': '057-stopwatch.png',
    'assigned': '005-calendar.png',
    'on_route': '028-express-delivery.png',
    'done': '015-delivered.png',
    'cancelled': '016-delivery-failed.png',
    'preview': '023-destination.png',
    undefined: '057-stopwatch.png'
};
let markers = [];


function removePreviewMarker() {
    let preview = markers['preview'];
    if (preview != null) {
        preview.remove();
    }
    delete markers['preview'];
}

function createMarkerFor(order) {
    const marker = L.marker([order.latitude, order.longitude],
        {
            icon: iconFor(order?.order_status),
            title: order.name,
        });
    marker.bindPopup(`<b>Order</b><br>Type: ${order.order_type}<br>Sheduled Date: ${order.scheduled_date}`);

    marker.on('click', function (e) {
        let row = $("tr[data-key='" + order.id + "']");

        $('.grid-view-container').animate({
            scrollTop: row.offset().top
        }, 800);

        row.effect("highlight", {color: 'Gainsboro'}, 1200);
    });

    markers[order.id] = marker;
    marker.addTo(myMap);
    return marker;
}

function removeMarkerByOrderId(orderId) {
    let marker = markers[orderId];
    if (marker != null) {
        marker.remove();
    }
    delete markers[orderId];
    fitMapBoundToMarkers();
}

function refreshOrderStatusById(orderId) {
    loadOneOrder(orderId, function (order) {
        refreshOrderStatus(order);
    }, function (e) {
        console.log(e);
    })
}

function refreshOrderStatus(order) {
    let marker = markers[order.id];
    if (marker == null) {
        createMarkerFor(order);
        return;
    }

    marker.setIcon(iconFor(order.order_status));
}

function iconFor(status) {
    return L.icon({
        iconUrl: `assets/logistics/${icons[status ?? 'undefined']}`,
        iconSize: [48, 48],
        shadowSize: [48, 48],
    });
}

function loadMap() {
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 19,
        attribution: '',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: accessToken
    }).addTo(myMap);

    loadAllOrders(function (orders) {
        orders.forEach((order) => createMarkerFor(order));

        fitMapBoundToMarkers();
    }, function () {
        console.log('error retrieving orders');
    });
}

function fitMapBoundToMarkers() {
    let group = new L.featureGroup();
    markers.forEach((marker) => marker.addTo(group));
    myMap.fitBounds(group.getBounds().pad(0.024));
}

$(document).on('click', ".order-row", function (e) {
    e.stopPropagation();
    let orderId = $(this).parents('tr').data('key');
    let marker = markers[orderId];
    if (marker == null) {
        console.log('no marker');
        return;
    }
    myMap.flyTo(marker.getLatLng(), 14);
});

$(document).on('click', '#preview-location', function (e) {
    const streetAddress = $('#street_address').val();
    const city = $('#city').val();
    const state = $('#state').val();
    const zipCode = $('#zip_code').val();
    const country = $('#country').val();

    getLocation({
        'street_address': streetAddress,
        'city': city,
        'state': state,
        'zip_code': zipCode,
        'country': country,
    }, (resp) => {
        removePreviewMarker();
        const previewMarker = L.marker([resp.results[0].location['lat'], resp.results[0].location['lng']],
            {
                icon: iconFor('preview'),
                title: 'Preview',
            });
        markers['preview'] = previewMarker;
        previewMarker.addTo(myMap);

        myMap.flyTo(previewMarker.getLatLng(), 14);

    }, (err) => {
        $.alert({
            title: 'Preview location',
            content: 'Could not find your location, please try again.',
            backgroundDismiss: true,
            type: 'red',
            typeAnimated: true
        });
    });
});

loadMap();