// JavaScript Document  
(function($){  
    // setbackground คือชื่อของ plugin ที่เราต้องการ ในที่นี้ ใช้ว่า  setbackground  
    $.fn.pholPhotoUpload= function( options ) { // กำหนดให้ plugin ของเราสามารถ รับค่าเพิ่มเติมได้ มี options  
     // ส่วนนี้ สำหรับกำหนดค่าเริ่มต้น  
	var defaults = {
		textColor: "#000",
		backgroundColor: "#fff"
	};
	// ส่วนสำหรับ  เป็นต้วแปร รับค่า options หากมี หรือใช้ค่าเริ่มต้น ถ้ากำหนด  
	var settings = $.extend( {}, defaults, options );
	// function
	function bytesToSize(bytes) {
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	   if (bytes == 0) return '0 Bytes';
	   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	}
	function chkFileSize(file){
		return file.size; //get file size
	}
	function chkFileType(file){
		return file.type; // get file type
	}
	function prepareUpload(event){
		files = event.target.files;
	}
	function previewImage(input) {
		for (var x = 0; x < input.get(0).files.length; x++) {
			file=input.get(0).files[x];
			if (file) {
				//alert(bytesToSize(chkFileSize(file)));
			  var reader = new FileReader();
			  reader.onload = function (e) {
				$('#list_img').append('<div class="callout callout-info"><div class="row"><div class="col-md-3"><span>Photo</span><img  class="img-responsive" src="'+e.target.result+'" width="150px"  /></div><div class="col-md-9"><span>Description</span><input class="form-control" type="text" name=txt_title[] /></div></div></div>');
			  }
			  reader.readAsDataURL(input.get(0).files[x]);
			}
		  }
	}
	function uploadFiles(event){
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
        $.ajax({
				url: 'submit.php?files',
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data, textStatus, jqXHR){
					if(typeof data.error === 'undefined'){
						//alert(data);
					}else{
						// Handle errors here
						 console.log('ERRORS: ' + data.error);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					// Handle errors here
					console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
				}
			});
		}
	// end function
       
        // คืนค่ากลับ การทำงานของ plugin  
        return this.each(function() {  
              $(this).change(function(event){ //onMouseOver
					alert(555);
					//prepareUpload(event);
            }
			
        });  
       
    };  
  
})(jQuery);  