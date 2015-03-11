

function initialize() {
    var styles = [
        {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [
                { "color": "#a2daf2" }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffe15f"
                }
            ]
        }
    ];
    var options = {
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        },
        center: new google.maps.LatLng(49.471489, 17.967118,18),
        zoom: 15,
        disableDefaultUI: true,
        mapTypeId: 'Styled'
    };
    var div = document.getElementById('map-canvas');
    var map = new google.maps.Map(div, options);
    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
    map.mapTypes.set('Styled', styledMapType);
}
google.maps.event.addDomListener(window, 'load', initialize);