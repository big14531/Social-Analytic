(function($) {
 
        $.fn.pholPhotoUpload = function(options) {
		var defaults = {
			usedAjax: true,
			formId: "",
			csrf_name:"",
			previewListPhotoId: "",
			successListPhotoId: "",
			tagInputHtmlPhotoUploadName:'',
			phpPathFileUpload:'',
			prefixedDel:'del_upload_photo_',
			jsonPhoto:'',
			delPhotoUploadedName:'chkDelete',
			loading:'.loading-img,.overlay',
			overlay:'.overlay',
			iconFlash:'img/flash.png',
			iconPdf:'img/pdf.png',
			iconWord:'img/pdf.png',
			showFileSize:true,
			caption: {
				show: true,
				tagInputHtmlCaptionName: "txtPhotoCation",
				labelCaptionTitle:"Cation"
			  },
			 link: {
				show: true,
				tagInputHtmlLinkName: "txtPhotoLink",
				labelLinkTitle:"Link"
			  }
		};
		var settings = $.extend( {}, defaults, options );
		
		// custom variable
		var filesUpload='';
		var obj ='';
		var arr_photo= new Array();
		var count=0;
		var count_for_del=0;
		var strCaption='';
		var strLink='';
		// function
		function bytesToSize(bytes) {
			if(bytes < 1024) return bytes + " Bytes";
			else if(bytes < 1048576) return(bytes / 1024).toFixed(2) + " KB";
			else if(bytes < 1073741824) return(bytes / 1048576).toFixed(2) + " MB";
			else return(bytes / 1073741824).toFixed(2) + " GB";
		};
		function chkFileSize(file){
			return file.size; //get file size
		}
		function chkFileType(file){
			return file.type; // get file type
		}
		function getFilesUpload(event){
			filesUpload= event.target.files;
		}
		function checkFileApi(){
			if (window.File && window.FileReader && window.FileList && window.Blob) {
			  // Great success! All the File APIs are supported.
			} else {
			  alert('The File APIs are not fully supported in this browser.');
			}
		}
		function previewImage(evt,input) {
			getFilesUpload(evt);
			var files = evt.target.files;
			for (var i = 0, f; f = files[i]; i++) {
			  if (!f.type.match('image.*')) {
				//continue;
			  }
			  strCaption='';
			if(settings.caption.show===true){
				strCaption='<p>'
										+'<span>'+settings.caption.labelCaptionTitle+'</span>'
										+'<input type="text" name="'+settings.caption.tagInputHtmlCaptionName+'[]"   class="form-control phol-check-description" />'
									+'</p>';
			  }
			strLink='';
			if(settings.link.show===true){
				strLink='<p>'
									+'<span>'+settings.link.labelLinkTitle+'</span>'
									+'<input  type="text"  class="form-control class_'+settings.link.tagInputHtmlLinkName+'" name="'+settings.link.tagInputHtmlLinkName+'[]" />'
								+'</p>';
			  }
			  
			  var reader = new FileReader();
			  // Closure to capture the file information.
			  reader.onload = (function(theFile) {
				return function(e) {
					// Render thumbnail.
					arr_photo[count]=theFile;
					 if (arr_photo[count].type.match('image.*')) {
						src=e.target.result;
					  }else if (arr_photo[count].type.match('.*flash.*')) {
						src=settings.iconFlash;
					  }
					  strFileSize='';
					  if(settings.showFileSize===true){
						strFileSize='<p>'
											+'<span>File size : '+bytesToSize(arr_photo[count].size)+'</span>'
										+'</p>';
					  }
					  output='<div class="callout callout-info" rel="'+count+'" id="'+options.prefixedDel+(count)+'" >'
																								+'<div class="row">'
																									+'<div class="col-md-1">'
																										+'<span>'+settings.labelPhoto+'</span>'
																										+'<img  class="img-responsive img-thumbnail" src="'+src+'" width="150px"  />'
																									+'</div>'
																									+'<div class="col-md-10">'
																										+strLink
																										+strCaption
																										+strFileSize
																									+'</div>'
																										+'<div class="col-md-1">'
																											+'<div class="close"  rel="'+settings.prefixedDel+(count)+'">X</div>'
																										+'</div>'
																								+'</div>'
																							+'</div>';
					$('#'+options.previewListPhotoId).prepend(output);
					count++
				};
			  })(f);
			  reader.readAsDataURL(f);
			}
		  }
		function showPhoto(json){
			$.each(json.files, function(key, v_photo){
				$('#'+options.successListPhotoId).prepend('<div class="callout bg_very_light_yellow ">'
																							+'<div class="row sortable">'
																									+'<div class="col-md-1">'
																											+'<span>'+options.labelPhoto+'</span>'
																											+'<img  class="img-responsive img-thumbnail" src="'+v_photo.photo+'"  />'
																											+'<input type="hidden" name="'+options.tagInputHtmlPhotoUploadName+'[]" value="'+v_photo.photo+'" />'
																									+'</div>'
																									+'<div class="col-md-10">'
																											+'<p>'
																												+'<span>'+options.labelDescription+'</span>'
																												+'<input type="text" name="'+options.tagInputHtmlDiscriptionName+'[]" value="'+v_photo.description+'"  class="form-control phol-check-description" />'
																											+'</p>'
																											+'<p>'
																												+'<span>'+settings.caption.labelCaptionTitle+'</span>'
																												+'<input type="text" name="'+settings.caption.tagInputHtmlCaptionName+'[]" value="'+v_photo.caption+'"  class="form-control" />'
																											+'</p>'
																									+'</div>'
																									+'<div class="col-md-1"> '
																										+'<div class="checkbox">'
																										+'<label>'
																										+'ลบ<input type="checkbox" name="'+options.delPhotoUploadedName+'[]" value="'+v_photo.photo+'" />'
																										+'</label>'
																									+'</div>'
																									+'</div>'
																							+'</div>'
																					+'</div>');
				$("input[type='checkbox']:not(.simple)").iCheck({
					checkboxClass: 'icheckbox_minimal'
				});
			});
		}
		function addErrorLabel(jquery_obj,label){
		  if(jquery_obj.parent().children('.custom_show_error').length==0){
		    jquery_obj.parent().addClass('has-error');
		    jquery_obj.before('<label class="control-label custom_show_error" for="inputError"><i class="fa fa-times-circle-o"></i>'+label+'</label>');
		  }
		}
		function removeErrorLabel(jquery_obj){
		  jquery_obj.parent().removeClass('has-error').children('.custom_show_error').remove();
		}
		function uploadFiles(event){
			 error=0;
			 /*
		      $('#'+options.formId+' .phol-check-description').each(function(k,v){
		           if($(this).val()==''){
		           		error++;
		                addErrorLabel($(this),'This field required.'); 
		           }
		      });
			  */
		    if(error==0){
				$('#'+options.formId+' '+options.loading).show();
				$('#'+options.formId+' '+options.overlay).show();
				event.stopPropagation(); // Stop stuff happening
				event.preventDefault(); // Totally stop stuff happening
				data = new FormData();
				if(options.csrf_name){
					data.append(options.csrf_name,$("input[name="+options.csrf_name+"]").val());
				}
				// START A LOADING SPINNER HERE
				$.each(arr_photo, function(key, value){
					data.append(options.tagInputHtmlPhotoUploadName+key, value);//example : value.name
				});
				
				// Create a formdata object and add the files
				$.each($('#'+options.formId+' :input'), function(key, value){
					data.append(value.name, value.value);//example : value.name
				});
				$.ajax({
						url: options.phpPathFileUpload,
						type: 'POST',
						data: data,
						cache: false,
						dataType: 'json',
						processData: false, // Don't process the files
						contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						success: function(data, textStatus, jqXHR){
							if(typeof data.error === 'undefined'){
								setTimeout(function () {
						          window.location.href=window.location.href;
						        },200);
								
								/*
								$('#'+options.previewListPhotoId).slideUp( "slow", function() {
									obj.val('');
									$(this).html('').show();
									showPhoto(data);
									arr_photo=new Array();
								  });
								  */
							}else{
								$('#'+options.formId+' '+options.loading).hide();
								$('#'+options.formId+' '+options.overlay).hide();
								 console.log('ERRORS: ' + data.error);
							}
						}
						,
						error: function(jqXHR, textStatus, errorThrown){
							// Handle errors here
							alert(errorThrown);
							$('#'+options.formId+' '+options.loading).hide();
							$('#'+options.formId+' '+options.overlay).hide();
							console.log(errorThrown);
							// STOP LOADING SPINNER
						}
					});
			}
		}	
                return this.each(function() {
					checkFileApi();
					obj = $('#'+options.tagInputHtmlPhotoUploadName);
					$('#'+options.tagInputHtmlPhotoUploadName).change(function(event) {
					    previewImage(event,obj);
					    return false;
					});    

					// $('#'+options.formId).delegate( ".phol-check-description", "keypress", function() {
					// 	removeErrorLabel($(this));
					// });
					$('#'+options.formId).delegate( ".phol-check-description", "focus", function() {
						removeErrorLabel($(this));
					});

					if(settings.usedAjax===true){
					$('#'+options.formId+'').submit(function(event) {
							uploadFiles(event);
							return false;
					}); 
					}

					$('#'+options.formId+'').delegate( ".close", "click", function() {
						imgDel=$('#'+$(this).attr('rel'));
						arr_photo.splice(imgDel.attr('rel'),1);
						imgDel.remove();

					});
                });
 
        }
 
})(jQuery);