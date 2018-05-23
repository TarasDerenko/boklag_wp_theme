/* show document info */
jQuery('.table-service').on('click','.service-title',function () {
    var id = jQuery(this).closest('.service-info').attr('data-id');
    var parent = jQuery(this).closest('li');
    var content = JSON.parse(parent.attr("data-content"));
    jQuery('.doc-info table').empty();
    parent.find('.doc-info table').append(renderDocs(content));
    var fix = jQuery('#info-'+id).hasClass('active');
    jQuery('.doc-info').removeClass('active');

    if(!fix){
        jQuery('#info-'+id).addClass('active');
    }

    jQuery('.popup-docs').attr('data-service','0').removeClass('active');
});

/* show documents window */
jQuery('.table-service').on('click','.add-doc',function () {
    var id = jQuery(this).attr('data-id');
    jQuery('.popup-docs').attr('data-service',id).toggleClass('active');
});

/* close documents window */
jQuery('.hide-popup').click(function () {
    var id = jQuery(this).closest('.popup-docs').attr('data-service','0').removeClass('active');
});

/* add new document */
jQuery(".document-single").click(function () {
    var service = jQuery(this).closest('.popup-docs').attr('data-service');
    var parent = jQuery('.service-info-'+service);
    var doc = jQuery(this).attr('data-id');
    jQuery.ajax({
        method:'post',
        url:wp_adm.url,
        data:{
            action:'add_doc_to_service',
            service:service,
            doc:doc
        },
        success:function(data){
            data = JSON.parse(data);
            alert(data.message);
            if(typeof data.data === 'object'){
                parent.attr('data-content',JSON.stringify(data.data));
                parent.find('.doc-info table').empty().append(renderDocs(data.data));
            }

        }
    });
});

/* delete document */
jQuery(".doc-info table").on('click','.remove-doc',function () {

    var doc = jQuery(this).attr('data-id');
    var service = jQuery(this).attr('data-sid');
    var parent = jQuery('.service-info-'+service);
    jQuery.ajax({
        method:'post',
        url:wp_adm.url,
        data:{
            action:'delete_doc_to_service',
            service:service,
            doc:doc
        },
        success:function(data){
            data = JSON.parse(data);
            alert(data.message);
            if(typeof data.data === 'object'){
                parent.attr('data-content',JSON.stringify(data.data));
                parent.find('.doc-info table').empty().append(renderDocs(data.data));
            }

        }
    });
});


jQuery('#add-service').click(function(){
    var val = jQuery('#service-title').val();

    jQuery.ajax({
        method:'post',
        url:wp_adm.url,
        data:{
            action:'add_service',
            val:val
        },
        success:function(data){
            data = JSON.parse(data);
            alert(data.message);
            if(typeof data.data === 'object'){
                jQuery('.table-service').append(renderSingleService(data.data));
                jQuery('#service-title').val('');
            }
        }
    });
});

jQuery('.table-service').on('click','.delete-service',function(){
    var id = jQuery(this).attr('data-id');
    var r = confirm('Вы уверены?');
    if(r == true){
        jQuery.ajax({
            method:'post',
            url:wp_adm.url,
            data:{
                action:'delete_service',
                id:id
            },
            success:function(data){
                data = JSON.parse(data);
                alert(data.message);
                if(data.data === 1){
                    jQuery('.service-info-'+id).remove();
                }
            }
        });
    }

});

jQuery('.table-service').on('click','.edit-service',function(){
   var parent = jQuery(this).closest('.service-info');
   var block = parent.find('.service-title');
    if(!parent.hasClass('edited')){
        var title = block.text();
        var textarea = createElement('textarea',{rows:5,cols:40});
        textarea.innerText = title;
        var button = createElement('input',{type:'button',value:'Сохранить',class:'save-service'});
        parent.addClass('edited');
        block.empty();
        block.append(textarea);
        block.append(button);
    }else{
        var title = block.find('textarea').val();
        block.empty();
        block.append(title);
        parent.removeClass('edited');
    }
});

jQuery('#add-document').click(function(){
    var val = jQuery('#service-title').val();
    var li,span,span_edit,div_name,div_action;
    jQuery.ajax({
        method:'post',
        url:wp_adm.url,
        data:{
            action:'add_boklag_document',
            val:val
        },
        success:function(data){
            data = JSON.parse(data);
            alert(data.message);
            if(typeof data.data === 'object'){
                div_name = createElement('div',{class:'doc-name'});
                div_action = createElement('div',{class:'doc-action'});
                li = createElement('li',{class:'document-single','data-id':data.data.id});
                span = createElement('span',{class:'delete-documents'},'Удалить');
                span_edit = createElement('span',{class:'edit-documents'},'Редактировать');
                div_name.innerText = val;
                div_action.appendChild(span_edit);
                div_action.appendChild(span);
                li.appendChild(div_name);
                li.appendChild(div_action);
                jQuery('.table-service').append(li);
                jQuery('#service-title').val('');
            }
        }
    });
});

jQuery('.table-service').on('click','span.delete-documents',function () {
    var parent = jQuery(this).closest('li');
    var id = parent.attr('data-id');
    var r = confirm('Вы уверены?');
    if(r == true){
        jQuery.ajax({
            method:'post',
            url:wp_adm.url,
            data:{
                action:'delete_boklag_document',
                id:id
            },
            success:function(data){
                data = JSON.parse(data);
                alert(data.message);
                if(data.data === 1){
                    parent.remove();
                }
            }
        });
    }
});


jQuery('.table-service').on('click','span.edit-documents',function () {
    var parent = jQuery(this).closest('li');
    var id = parent.attr('data-id');
    var block = parent.find('.doc-name');
    if(!parent.hasClass('edited')){
        var title = block.text();
        var textarea = createElement('textarea',{rows:5,cols:40});
        textarea.innerText = title;
        var button = createElement('input',{type:'button',value:'Сохранить',class:'save-document'});
        parent.addClass('edited');
        block.empty();
        block.append(textarea);
        block.append(button);
    }else{
        var title = block.find('textarea').val();
        block.empty();
        block.append(title);
        parent.removeClass('edited');
    }
});

jQuery('.table-service').on('click','.save-document',function () {
    var parent = jQuery(this).closest('li');
    var id = parent.attr('data-id');
    var block = parent.find('.doc-name');
    var val = block.find('textarea').val();
    var r = confirm('Вы уверены?');
    if(r == true){
        jQuery.ajax({
            method:'post',
            url:wp_adm.url,
            data:{
                action:'edit_boklag_document',
                id:id,
                val:val
            },
            success:function(data){
                data = JSON.parse(data);
                alert(data.message);
                if(data.data === 1){
                    block.empty();
                    block.append(val);
                    parent.removeClass('edited');
                }
            }
        });
    }
});


jQuery('.table-service').on('click','.save-service',function () {
    var parent = jQuery(this).closest('.service-info');
    var block = parent.find('.service-title');
    var id = parent.attr('data-id');
    var val = block.find('textarea').val();
    var r = confirm('Вы уверены?');
    if(r == true){
        jQuery.ajax({
            method:'post',
            url:wp_adm.url,
            data:{
                action:'edit_boklag_service',
                id:id,
                val:val
            },
            success:function(data){
                data = JSON.parse(data);
                alert(data.message);
                if(data.data === 1){
                    block.empty();
                    block.append(val);
                    parent.removeClass('edited');
                }
            }
        });
    }
});

jQuery('.table-service').on('click','textarea',function (e) {
    e.stopPropagation();
});

function renderDocs(arr) {
    var tr,td_1,td_2,button,tbody;
    tbody = createElement('tbody');
    for (key in arr){
        if(key == '')
            continue;
        tr = createElement('tr');
        td_1 = createElement('td',{},arr[key].title);
        td_2 = createElement('td');
        button = createElement('button',{class:'remove-doc','data-id':key,'data-sid':arr[key].serId},'Удалить');
        td_2.appendChild(button);
        tr.appendChild(td_1);
        tr.appendChild(td_2);
        tbody.appendChild(tr);
    }
    return tbody;
}

function renderSingleService(data){
    var li,div_title,ul,li_i,table,button,button_del;
    button = createElement('button',{class:'add-doc btn','data-id':data.id},'Добавить Документ');
    button_del = createElement('button',{class:'delete-service btn','data-id':data.id},'Удалить Услугу');
    table = createElement('table');
    li_i = createElement('li',{class:'doc-info',id:'info-'+data.id});
    li_i.appendChild(table);
    li_i.appendChild(button);
    li_i.appendChild(button_del);
    ul = createElement('ul');
    ul.appendChild(li_i);
    div_title = createElement('div',{class:'service-title'},data.title);
    li = createElement('li',{class:'service-info service-info-'+data.id,'data-id':data.id,'data-content':JSON.stringify({})});
    li.appendChild(div_title);
    li.appendChild(ul);
    return li;
}


function createElement(tag,attr,text) {
    var el = document.createElement(tag);
    if(attr){
        for(name in attr){
            el.setAttribute(name,attr[name]);
        }
    }
    if(text){
        el.innerText = text;
    }
    return el;
}

