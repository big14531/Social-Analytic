function addErrorLabel(jquery_obj,label){
  if(jquery_obj.parent().children('.custom_show_error').length==0){
    //jquery_obj.before();
    jquery_obj.parent().addClass('has-error');
    jquery_obj.before('<label class="control-label custom_show_error" for="inputError"><i class="fa fa-times-circle-o"></i>'+label+'</label>');
  }
}
function removeErrorLabel(jquery_obj){
  jquery_obj.parent().removeClass('has-error').children('.custom_show_error').remove();
}
function youtube_parser(url){
 var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
  var ID = '';
  var pattern_chk_youtube = /(youtube\.com)|(youtu\.be)/i;
  if(url.match(pattern_chk_youtube)){
    url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    if(url[2] !== undefined) {
      ID = url[2].split(/[^0-9a-z_\-]/i);
      ID = ID[0];
    }
    else {
      ID = false;
    }
  }
    return ID;
}
function kclSerializeData(form_ele){
    formData = new FormData();
    // // Create a formdata object and add the files
    $.each($(form_ele+' :input'), function(key, value){
      if($(this).attr('type')==='file'){
        if($(this)[0].files[0]!=undefined){
          formData.append($(this).attr('name'), $(this)[0].files[0]);
        }
        
      }else if($(this).attr('type')==='checkbox' || $(this).attr('type')==='radio'){
        if($(this).attr('checked')=='checked')
        {
          formData.append(value.name, value.value);//example : value.name
        }else{
          formData.append(value.name,'');//example : value.name
        }
        
      }else{
        formData.append(value.name, value.value);//example : value.name
      }
      
    });
    return formData;
}