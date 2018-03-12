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
function onSignIn(googleUser) {
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
}
