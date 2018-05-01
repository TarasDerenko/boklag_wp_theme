google.maps.event.addDomListener(window, 'load', init);
var selecting = false;
var mauseDown = 0;
window.onkeydown = function(e) {
    selecting = ((e.keyIdentifier == 'Shift') || (e.shiftKey == true));
    if(marker)
        marker.setOptions({draggable: false});
};
window.onkeyup = function(e) {
    selecting = false;
    if(marker)
        marker.setOptions({draggable: true});
};

var rang = 0;
var circle = false;
var zoom = 11;
var inp_lat = document.getElementById('map-lat');
var inp_lng = document.getElementById('map-lng');
var inp_rang = document.getElementById('map-rang');
var marker,map,positionLatLng;
function init(){

    var markerOptions = {
        position: new google.maps.LatLng(50.454580, 30.518430),
        draggable: true,
        icon: wp_map.marker
    };
    var mapOptions = {
        zoom: zoom,
        center: new google.maps.LatLng(50.454580, 30.518430),
        styles: [],
        disableDoubleClickZoom: false
    };
    if(positionLatLng){
        mapOptions.center = positionLatLng;
        markerOptions.position = positionLatLng;
    }
    var mapElement = document.getElementById('map');
    if (mapElement == null) {
        return;
    }
    map = new google.maps.Map(mapElement, mapOptions);

    markerOptions.map = map;


    marker = new google.maps.Marker(markerOptions);
    if(inp_lat && inp_lng){
        inp_lat.value = marker.position.lat();
        inp_lng.value = marker.position.lng();
    }

    circle = getCircle(0,marker.position,map);

    /*map.addListener('dblclick',function (e) {
        rang = 0;
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: e.latLng,
            map: map,
            draggable: true,
            icon: wp_map.marker
        });
        inp_lat.value = marker.position.lat();
        inp_lng.value = marker.position.lng();

        if(circle)
            circle.setMap(null);

        marker.addListener('dragend',function(){
            if(circle)
                circle.setMap(null);
            circle = getCircle(rang,this.position,map);

            inp_lat.value = this.position.lat();
            inp_lng.value = this.position.lng();
        });

    });*/
    map.addListener('dragend',function (e) {
        map.setOptions({draggable: true});
    });

    marker.addListener('dragend',function(){
        if(circle)
            circle.setMap(null);
        circle = getCircle(rang,this.position,map);
        inp_lat.value = this.position.lat();
        inp_lng.value = this.position.lng();
    });

    google.maps.event.addListener(map,'mousemove',function (e) {
       if(selecting) {
            map.setOptions({draggable: false});
            if(mauseDown) {
                if (circle)
                    circle.setMap(null);
                rang = Math.sqrt(Math.pow((marker.position.lat() - e.latLng.lat()), 2) + Math.pow((marker.position.lng() - e.latLng.lng()), 2));
                if (zoom < 16)
                    rang = rang * 1000 / zoom;
                else
                    rang = rang * 100;
                circle = getCircle(rang, marker.position, map);
                inp_rang.value = rang;
            }
        }
    });

    google.maps.event.addListener(map,'mouseup',function (e) {
        mauseDown = 0;
        map.setOptions({draggable: true});
    });

    google.maps.event.addListener(map,'mousedown',function (e) {
        mauseDown = 1;
    });

    map.addListener('zoom_changed',function (e) {
        zoom = this.zoom;
    });



}

function getCircle(rang,center,map) {
    return new google.maps.Circle({
        strokeColor: '#FF515E',
        strokeOpacity: 0.6,
        strokeWeight: 3,
        fillColor: '#FF0000',
        fillOpacity: 0.1,
        map: map,
        center: center,
        radius: rang * 1000
    })
}

