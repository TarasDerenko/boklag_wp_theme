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