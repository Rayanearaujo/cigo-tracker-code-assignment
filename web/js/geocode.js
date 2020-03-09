const baseGeocodioUrl = 'https://api.geocod.io/v1.4';

function getLocation(data, successCallback, errorCallback){
    $.ajax({
        url: baseGeocodioUrl + '/geocode',
        type: 'get',
        data: {
            street: data['street_address'],
            city: data['city'],
            state: data['state'],
            postal_code: data['zip_code'],
            country: data['country'],
            api_key: 'e6597555535eb5fbe6b3e9396ef5f3e75647566'
        },
        success: response => {
            if (response['results'].length > 0) {
                successCallback(response);
            } else {
                errorCallback(response);
            }
        },
        error: xhr => {
            errorCallback(xhr);
        },
    });
}