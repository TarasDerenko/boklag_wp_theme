$('.personal-content-photo .button-delete').click(function(){
	$('.personal-photo img').attr('src','');
	$('[name=delete-avatar]').val($(this).attr('data-avatar'));
});

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.personal-photo img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".button-reload").change(function() {
  readURL(this);
});

$()
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
        types: [],
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

$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});

$('.location-form-row [name=region]').on('focus',function(){
    //readOnlyAutoComplete(this);
    get_autocomplite(this);
});

// $('.location-form-row [name=]').on('focus',function(){
//     readOnlyAutoComplete(this,'Івано-Франківськ, ');
// });

function get_autocomplite(el){
    autocomplete = new google.maps.places.Autocomplete(el,{
        componentRestrictions: {country: 'ua'}
    });
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
$('.reminder-field-date').mask('00/00/0000');