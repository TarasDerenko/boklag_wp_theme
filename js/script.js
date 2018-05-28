$(document).ready(function () {
    getLocation();
});
$('.personal-content-photo .button-delete').click(function(){
	$('.personal-photo img').attr('src','');
	$('[name=delete-avatar]').val($(this).attr('data-avatar'));
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.personal-photo img').attr('src', e.target.result);
      $(input).closest('.personal-photo-buttons').addClass('save');
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".button-reload").change(function() {
  readURL(this);
});


function checkPasswordStrength(pass,input) {
	$(input).parent().removeClass('bad good strong normal');
    var strength = valid_pass(pass);
  
    switch (strength) {
        case 1:
            $(input).parent().addClass('bad');
            break;
        case 2:
            $(input).parent().addClass('normal');
            break;
        case 3:
            $(input).parent().addClass('good');
            break;
        case 4:
            $(input).parent().addClass('strong');
            break;
        default:
            $(input).parent().removeClass('bad good strong normal');
    }

}

function checkPasswordCopy(inp1,inp2) {
    if(inp1.val() !== inp2.val()){
       return false;
    }else{
       return true;
    }
}


function valid_pass(pass){
	if(!pass)
		return 0;
    if(pass.length < 6){
        return 1;
    }
    if(!hasUpperCase(pass)){
        return 2;
    }
     if(!hasLoverCase(pass)){
        return 2;
    }
    if(!hasSymbolCase(pass)){
         return 3;
    }
    return 4;
}

function hasUpperCase(str) {
    return (/[A-Z]/.test(str));
}
function hasLoverCase(str) {
    return (/[a-z]/.test(str));
}
function hasSymbolCase(str) {
    return (/[-!$@%^&*()_+|~=`{}\[\]:";'<>?,.\/]/.test(str));
}

$('#registration [name=pwd]').on('input',function(){
	checkPasswordStrength($(this).val(),this);
});

$('[name=user_new_pass]').on('input',function () {
    var comp = $(this).siblings('.personal-complete');
    if(valid_pass($(this).val()) > 1){
        if(!comp.hasClass('active'))
            comp.addClass('active');
    }else{
        comp.removeClass('active');
    }
});

$('[name=user_new_cop_pass]').on('input',function () {
    var comp = $(this).siblings('.personal-complete');
    if(checkPasswordCopy($('[name=user_new_pass]'),$(this))){
        if(!comp.hasClass('active'))
            comp.addClass('active');
    }else{
        comp.removeClass('active');
    }
});

$(".wpcf7").on('wpcf7:mailfailed', function(event){
    $(this).find('.error-message').html('<span class="text-error">Не удалось отправить сообщение!</span>');
});

$(".wpcf7").on('wpcf7:mailsent', function(event){
    $(this).find('.error-message').html('<span class="text-success">Сообщения Отправлено!</span>');
});

function readOnlyAutoComplete(el,type){
    var input = el;
    var autocomplete;
    var place;
    var country;
    var geoCoder = new google.maps.Geocoder();
    var options = {
        types: ['(streets)'],
        componentRestrictions: {country: 'ua'},
        place_changed: function(result) {
            var locBounds;
            var inputName;
            place = autocomplete.getPlace();

            geoCoder.geocode({'location':{lat: place.geometry.location.lat(), lng: place.geometry.location.lng()}}, function(results, status) {  /* address: place.name */
                if (results[0]) locBounds = results[0].geometry.viewport;

                var componentForm = {
                    street_number: 'short_name',
                    route: 'long_name',
                    locality: 'long_name',
                    administrative_area_level_1: 'short_name',
                    country: 'short_name',
                    postal_code: 'short_name'
                };
                var place = results[0];

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        componentForm[addressType] = place.address_components[i][componentForm[addressType]];
                    }
                }

            });
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                positionLatLng = {
                    sender: null,
                    timestamp: null,
                    lat: lat,
                    lng: lng
                };
                init();
                // document.getElementById('profileform-lat').value = data.lat;
                // document.getElementById('profileform-lng').value = data.lng;

            $(input).val(place.formatted_address)
        }
    };
    if(country = $('#profileform-city').attr('data-country'))
        options.componentRestrictions = {country:country};
    autocomplete = new google.maps.places.Autocomplete(el, options);
}

$(document).on("keypress", '#order-form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});

$('.location-form-row [name=region]').on('focus',function(){
    var data = {
        types:['(regions)']
    };
    var city = $('.location-form-row [name=settlement]');
    city.empty();
    google.maps.event.clearInstanceListeners(city);
    get_autocomplite(this,data);
});

$('.location-form-row [name=settlement]').on('focus',function(){
    var data = {
        strictBounds: true,
        bounds: new google.maps.LatLngBounds(
            {
                lat:  parseFloat($('#map-lat-1').val()),
                lng:  parseFloat($('#map-lng-1').val())
            },
            {
                lat:  parseFloat($('#map-lat-2').val()),
                lng:  parseFloat($('#map-lng-2').val())
            }
        ),
        types:['(cities)']
    };
    var street = $('.location-form-row [name=street]');
    street.empty();
    google.maps.event.clearInstanceListeners(street);
    get_autocomplite(this,data);
});

$('.location-form-row [name=street]').on('focus',function(){
    var data = {
        strictBounds: true,
        bounds: new google.maps.LatLngBounds(
            {
                lat:  parseFloat($('#map-lat-1').val()),
                lng:  parseFloat($('#map-lng-1').val())
            },
            {
                lat:  parseFloat($('#map-lat-2').val()),
                lng:  parseFloat($('#map-lng-2').val())
            }
        )
    };
    get_autocomplite(this,data);
});

function get_autocomplite(el,data){
    var input = el;
    var options = {
        componentRestrictions: {country: 'ua'},
        place_changed: function(result) {
            place = autocomplete.getPlace();
            if(!place)
                return;

            inp_lat = place.geometry.location.lat();
            inp_lng = place.geometry.location.lng();
            $('#map-lat').val(inp_lat);
            $('#map-lng').val(inp_lng);
            $('#map-lat-1').val(place.geometry.viewport.f.b);
            $('#map-lng-1').val(place.geometry.viewport.b.b);
            $('#map-lat-2').val(place.geometry.viewport.f.f);
            $('#map-lng-2').val(place.geometry.viewport.b.f);
            $('#map-lng').val(inp_lng);
            positionLatLng = {
                sender: null,
                timestamp: null,
                lat: inp_lat,
                lng: inp_lng
            };
            init();
            if($(input).attr('name') == 'region' && !!place){
                $('[name=settlement]').prop('disabled',false);
            }
            if($(input).attr('name') == 'settlement' && !!place){
                $('[name=street]').prop('disabled',false);
                $('[name=house]').prop('disabled',false);
            }
        }
    };
    if(data){
        for(var k in data){
            options[k] = data[k];
        }
    }
    autocomplete = new google.maps.places.Autocomplete(el,options);
}


$('tbody').on('input','.reminder-field-hour',function(){
    var val = this.value;
    var inValid = /^\d+$/;
    if(!inValid.test(val) || val.length > 2)
        this.value = val.substring(0,(val.length - 1));
    if(val > 23)
        this.value = 23;
});

$('tbody').on('input','.reminder-field-min',function(){
    var val = this.value;
    var inValid = /^\d+$/;
    if(!inValid.test(val) || val.length > 2)
        this.value = val.substring(0,(val.length - 1));
    if(val > 59)
        this.value = 59;
});
var reminderDate = $('.reminder-field-date');
if(!!reminderDate.mask)
    $('.reminder-field-date').mask('00/00/0000');


$('.order-info').click(function(){
    initMap($(this).attr('data-id'));
});
function initMap(id) {
    var mapElement = document.getElementById('map-'+id);
    if (mapElement == null) {
        return;
    }
    var markerOptions = {
        position: new google.maps.LatLng($(mapElement).attr('data-lat'), $(mapElement).attr('data-lng')),
        draggable: false,
        icon: wp_map.marker
    };
    var mapOptions = {
        zoom: zoom,
        center: new google.maps.LatLng($(mapElement).attr('data-lat'), $(mapElement).attr('data-lng')),
        styles: [],
        disableDoubleClickZoom: false
    };


    map = new google.maps.Map(mapElement, mapOptions);

    markerOptions.map = map;


    marker = new google.maps.Marker(markerOptions);
    circle = getCircle($(mapElement).attr('data-rang'),marker.position,map);
}

var userTel = $('[name=user_tel]');

if(!!userTel.mask){
    userTel.mask('+38 (000) 000-00-00');
}else{
    userTel.on('input',function () {
        var val = $(this).val();
        if(!/^\d+$/.test(val) || val.length > 12){
            $(this).val(val.substring(0,val.length - 1));
        }
        return;
    });
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

$('[name=user_email]').on('input',function () {
    var email = $(this);
    complete = email.siblings('.personal-complete');
    if(validateEmail(email.val())){
        if(!complete.hasClass('active'))
            complete.addClass('active');
    }else{
        complete.removeClass('active');
    }
});

userTel.on('input',function () {
    var comp = $(this).siblings('.personal-complete');
    if($(this).val().length > 18){
        if(!comp.hasClass('active'))
            comp.addClass('active');
    }else{
        comp.removeClass('active');
    }
});

$('.change-password-button').click(function () {
    $('.change-password-block').toggleClass('active');
});

$('.order-info td:last-child').click(function (event) {
   event.stopPropagation();
});
$('.order-detailed-answer button').click(function (e) {
    e.preventDefault();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var content = file_get_contents( "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude+","+position.coords.longitude+"&components=locality&language=ru&key=AIzaSyCMz6ybbsM30th_jIWkEQMXNYMDCtU_j-k" );
    var content = JSON.parse(content);

    if(content.results){
        var res = geoResult(content.results[0]);
        if(res && res.locality){
            $('[name="city-current"]').val(res.locality);
            $('.location-current-text span').text(res.locality);
        }
    }


}

$('.location-another-select [name=my-city]').on('focus',function(){
    var data = {
        types:['(regions)']
    };
    autocomplete = new google.maps.places.Autocomplete(this,data);
});

function file_get_contents( url ) {
    var req = null;
    try { req = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
        try { req = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {
            try { req = new XMLHttpRequest(); } catch(e) {}
        }
    }
    if (req == null) throw new Error('XMLHttpRequest not supported');

    req.open("GET", url, false);
    req.send(null);

    return req.responseText;
}

function geoResult(place) {
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            componentForm[addressType] = place.address_components[i][componentForm[addressType]];
        }
    }
    return componentForm;
}