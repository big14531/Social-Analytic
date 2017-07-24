(function( $ ) {
 
    // Plugin definition.
    $.fn.uploadPreview = function( options ) {
        var defaults = {
			preview_box: "#file_icon_preview",
			show_file_type: true,
			max_width:5500

		};
		var settings = $.extend( {}, defaults, options );
		
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
		
		
		return this.each(function(obj) {
				$(this).change(function () {
					file_id=$(this).attr('id');
					if (typeof (FileReader) != "undefined") {
						var dvPreview = $(options.preview_box);
						dvPreview.html("");
						var regex = /^(.)+(.jpg|.jpeg|.gif|.png|.bmp)$/;
						$($(this)[0].files).each(function () {
							var file = $(this);
							if (regex.test(file[0].name.toLowerCase())) {
								var reader = new FileReader();
								reader.onload = function (e) {
									// var img = $("<img />");
									// img.attr("style", "height:100px;width: 100px");
									// img.attr("src", e.target.result);
									// dvPreview.append(img);
									// dvPreview.append(img);
									label_style='label label-success';
									panel_style='panel panel-default';
									var image = new Image();
									image.src = e.target.result;

									image.onload = function() {
										if(image.width>options.max_width){
											alert('ขนาดไฟล์กว้างเกิน '+options.max_width+'px  ระบบจะไม่สามารถอัพโหลดไฟล์นี้ได้ !!!!');
											label_style='label label-danger';
											panel_style='panel panel-danger';
											$('#'+file_id).val('');
										}
										dvPreview.append('<div>');
										str_html='<div class="'+panel_style+'">'+
													  '<div class="panel-body">'+
														'<img src="'+(image.src)+'" width="150"/>'+
													  '</div>'+
													  '<div class="panel-footer">'+
															'<span class="'+label_style+'">ความกว้าง : '+image.width+' px</span><br>'+
															'<span class="label label-primary">ขนาดไฟล์ : '+bytesToSize(file[0].size)+'</span>';
										if(options.show_file_type==true){
											str_html+='<span class="label label-primary">File type : '+chkFileType(file[0])+'</span>';
										}
										str_html+='</div>'+'</div>';
										dvPreview.append(str_html);
									};
									
									
									 
									/*
									if(file[0].width>options.max_width){
										alert('ขนาดไฟล์ใหญ่่เกิน '+options.max_width+' พิกเซล ');
									}
									*/
								}
								reader.readAsDataURL(file[0]);
							} else {
								error_msg=file[0].name + " is not a valid image file."
								alert(error_msg);
								dvPreview.html("");
								console.log(error_msg);
								return false;
							}
						});
					} else {
						error_msg="This browser does not support HTML5 FileReader.";
						console.log(error_msg);
					}
			});
		});
		
    };
 
 
})( jQuery );