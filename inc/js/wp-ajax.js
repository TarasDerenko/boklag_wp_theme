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

$('.order-pagination').on('click','a',function(){
	var paged = $(this).attr('data-paged');
	var table = $('.content-table');
	var type = table.attr('data-type');
	var mark = table.attr('data-mark');
	$.ajax({
		method:'post',
		url:wp_ajax.url,
		data:{
			action:'ajax_bl_orders',
			paged:paged,
			type:type,
			mark:mark
		},
		success:function(data){
			var tr,td,label,
				block = $('.content-table tbody');
			block.empty();
			data = JSON.parse(data);
			$('.order-pagination').html(data.pag);

			for(var i = 0; i < data.orders.length; i++){
				tr = myCreateElement('tr',{'data-order':data.orders[i].id});
                tr.appendChild(myCreateElement('td',{},data.orders[i].id));
                tr.appendChild(myCreateElement('td',{},data.orders[i].title));
                tr.appendChild(myCreateElement('td',{},data.orders[i].status));
                tr.appendChild(myCreateElement('td',{},data.orders[i].address));
                tr.appendChild(myCreateElement('td',{},data.orders[i].date_end));
                if(table.hasClass('delete-table')){
                    td = myCreateElement('td');
                    label = myCreateElement('label',{class:'custom-checkbox'});
                    label.appendChild(myCreateElement('input',{type:'checkbox',value:data.orders[i].id}));
                    label.appendChild(myCreateElement('div',{class:'custom-checkbox-image2'}));
                    td.appendChild(label);
                    tr.appendChild(td);
                }
                if(table.hasClass('reminder-table')){
                    td = myCreateElement('td',{},data.bell);
                    tr.appendChild(td);
                }
                block.append(tr);
            }
            document.body.scrollTop = document.documentElement.scrollTop = 0;
            var reminderButttons = document.querySelectorAll('.set-reminder-button');

            if (reminderButttons) {
                reminderButttons.forEach(function(button) {
                    button.addEventListener('click', setReminder);
                });
            }
		}
	});
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

