/**
 * Created by kilanoff on 25.11.16.
 */
// When the window has finished loading create our google map below

function init() {
    var mapOptions = {
        zoom: 11,
        center: new google.maps.LatLng(55.2368317857906, 37.52949905789707), // New York
        styles: [
            {
                "featureType": "all",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "weight": 0.5
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative.country",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "lightness": "16"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#405783"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#5580aa"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#011066"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#272664"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#27abda"
                    }
                ]
            }
        ]
    };

    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var tmp = UF_GOOGLE_MAP_DATA.split(',');
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(tmp[0], tmp[1]),
        map: map,
        icon: '/local/templates/main/images/flyer.png',
        animation: google.maps.Animation.BOUNCE,
        title: 'Snazzy!'
    });
}

$(function(){
    google.maps.event.addDomListener(window, 'load', init);
});