$('.about-news-add a').click(function(){
	var show = $('.about-news-item').length;
	var total = $('.about-news-list').attr('data-total');
	$.ajax({
		method:'post',
		url:wp_ajax.url,
		data:{
			action:'show_news_more',
			offset:show
		},
		success:function(data){
			if(!data)
				return;
			data = JSON.parse(data);
			var item;

			for (var i = 0; i < data.length; i++) {
				$('.about-news-list').append(create_news(data[i]));
			}		
		}
	});
	if((parseInt(show) + 3) >= total)
		$(this).remove();
	return false;
});

function create_news(item){
	var block,block_image,block_info,img,date,date_spam,block_title,block_text,block_more,more,img_src;
	img_src = '';
	if(item.img)
		img_src = item.img;

	img = myCreateElement('img',{src:img_src,alt:''});
	more = myCreateElement('a',{href:'#',class:'about-news-extend'},'подробнее');
	more.addEventListener('click', extendNewsInfo);
	date_spam = myCreateElement('spam',{},item.date);
	date = myCreateElement('div',{class:'about-news-date'});
	block_more = myCreateElement('div',{class:'about-news-more'},item.after_more);
	block_text = myCreateElement('div',{class:'about-news-text'},item.before_more);
	block_title = myCreateElement('h3',{class:'about-news-title'},item.title);
	block_image = myCreateElement('div',{class:'about-news-image'});
	block_info = myCreateElement('div',{class:'about-news-info'});
	block = myCreateElement('div',{class:'about-news-item'});

	block_image.appendChild(img);
	date.appendChild(date_spam);
	block_image.appendChild(date);
	block_info.appendChild(block_title);
	block_info.appendChild(block_text);
	block_info.appendChild(block_more);
	block_info.appendChild(more);
	block.appendChild(block_image);
	block.appendChild(block_info);
	return block;
}

function myCreateElement(tag,attr,child){
	var el = document.createElement(tag);
	if(attr){
		for(var key in attr)
			el.setAttribute(key,attr[key])				
	}
	if(child)
		el.innerHTML = child;
	return el;
}
/******************************************************/
var auth2;
function gInit() {
    gapi.load('auth2', function(){
        auth2 =  gapi.auth2.init({
            client_id: '784347025730-uct0opjdbesr2rb1pcgdc12c4i7a9uit.apps.googleusercontent.com'
        });
    });
}
$('.popup-captcha-google').click(function(){
    auth2.signIn({
        scope: 'profile email'
    }).then(function (googleUser) {
        var profile = googleUser.getBasicProfile();
        var token = googleUser.getAuthResponse().id_token;
        $.ajax({
            method: 'post',
            url: wp_ajax.url,
            data: {
                action:'google_login',
                id: profile.getId(),
                name: profile.getName(),
                email: profile.getEmail(),
                image: profile.getImageUrl(),
                token: token
            },
            success: function(msg){
                window.location.href = "/";
            },
            error: function(){
            }
        })
    });
});

$('.select-city').on('change','input, select',function(){
	$(this).closest('form').submit();
});


function myCreateElement(tag,attr,text){
	var el = document.createElement(tag);
	if(attr){
		for(var prop in attr)
			el.setAttribute(prop,attr[prop]);
	}
	if(text)
		el.innerHTML = text;
	return el;
}


$('tbody').on('click','.button-invert',function(){
	var tr = $(this).closest('tr');
	var order_id = tr.attr('data-order');
	var date = tr.find('.reminder-field-date').val();
	var hour = tr.find('.reminder-field-hour').val();
	var min = tr.find('.reminder-field-min').val();
	$.ajax({
		method:'post',
		url:wp_ajax.url,
		data:{
			action:'set_order_reminder',
			user_id:wp_ajax.user_id,
			id:order_id,
			date:date,
			hour:hour,
			min:min
		},
		success:function(data){
			if(data == 1){
				$('.set-reminder-button,.reminder-form').removeClass('active');
			}
		}
	});
	return false;
});

$('.notification-dropdown').on('click','.notification-dropdown-close',function () {
	var _this = this;
	var type = $(this).attr('data-type');
	var id = $(this).attr('data-notification');
	var count = $('.notification-count');

	$.ajax({
		method:'post',
		url:wp_ajax.url,
		data:{
			action:'update_notification',
			type:type,
			id:id,
			user_id:wp_ajax.user_id
		},
		success:function (data) {

			data = JSON.parse(data);
			$(_this).closest('.notification-dropdown').html(data.nots);


			if(data.count > 0){
                count.text(data.count);
			}else{
                count.remove();
                $('.notification-dropdown').removeClass('active');
			}


        }
	});
});


$( "[name=checkorder]" ).autocomplete({
    source: function(request, response) {
        $.ajax({
            method: 'post',
            url: wp_ajax.url,
            data: {
            	action:'service_autocomplete',
                s: request.term
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.length === 0) {
                    response({
                        label: "Нету такой услуги!"
                    });

                } else {

                   response(jQuery.map(data, function(value, key) {
                        return {
                            label: value.title,
                            value: value.title,
                            id: value.id
                        }
                    }));
                }
            }
        });
    },
    select: function(event, ui) {
    	$(this).val(ui.item.value);
    	$(this).attr('data-id',ui.item.id);
    }
});

$(".mark-set-color").click(function () {
	var el = $(this);
	$.ajax({
		method:'post',
		url:wp_ajax.url,
		data:{
			action:'change_mark',
			id:el.closest('.mark-set').attr('data-id'),
			mark:el.attr('data-mark')
		},
		success:function (data) {
			console.log(data);
        }
	});
    ;
});
