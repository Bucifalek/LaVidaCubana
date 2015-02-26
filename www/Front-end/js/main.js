function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
    center: new google.maps.LatLng(49.472170, 17.987900),
    zoom: 8,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)
    }
google.maps.event.addDomListener(window, 'load', initialize);


