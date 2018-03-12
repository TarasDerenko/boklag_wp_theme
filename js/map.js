google.maps.event.addDomListener(window, 'load', init);

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 8,
        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(50.454580, 30.518430), // KYIV
        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
        styles: []
    };
    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');
    if (mapElement == null) {
        return;
    }
    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);
    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(50.454580, 30.518430),
        map: map,
        icon: '../img/map-marker.png'
    });
}