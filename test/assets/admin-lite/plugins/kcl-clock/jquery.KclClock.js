(function( $ ) {
 
    // Plugin definition.
    $.fn.KclClock = function( options ) {
        var defaults = {
			message :'เวลาปัจจุบัน',
			url_get_time:''
		};
		var kcl_clock_current_time='';
		var settings = $.extend( {}, defaults, options );
		var this_id=this.attr('id');
		this.append('<ul class="kcl-clock-show-time">'+
                      '<li>'+options.message+' : </li>'+
                        '<li class="kcl-clock-hours">-</li>'+
                          '<li class="kcl-clock-point">:</li>'+
                          '<li class="kcl-clock-min">-</li>'+
                          '<li class="kcl-clock-point">:</li>'+
                          '<li class="kcl-clock-sec">-</li>'+
                     '</ul>');
		var kcl_clock_obj_min=$("#"+this_id+" ul .kcl-clock-min");
		var kcl_clock_obj_hour=$("#"+this_id+" ul .kcl-clock-hours");
		var kcl_clock_obj_second=$("#"+this_id+" ul .kcl-clock-sec");

		function getServerTime(){
			if(kcl_clock_current_time==''){
				$.get(options.url_get_time, function( data ) {
			  		var serverDay = new Date(data);
					var localDay = new Date();
					localDay.setTime(serverDay.getTime());
					kcl_clock_current_time=serverDay.getTime();
				});
			}
		}
		getServerTime();
		setInterval( function() {
		  //getServerTime();
		  if(kcl_clock_current_time){
			kcl_clock_date=new Date();
			kcl_clock_current_time+=1000;
			kcl_clock_date.setTime(kcl_clock_current_time);
			kcl_clock_seconds = kcl_clock_date.getSeconds();
			kcl_clock_minutes = kcl_clock_date.getMinutes();
			kcl_clock_hours = kcl_clock_date.getHours();
			// Add a leading zero to seconds value
			kcl_clock_obj_second.html(( kcl_clock_seconds < 10 ? "0" : "" ) + kcl_clock_seconds);
			kcl_clock_obj_min.html(( kcl_clock_minutes < 10 ? "0" : "" ) + kcl_clock_minutes);
			kcl_clock_obj_hour.html(( kcl_clock_hours < 10 ? "0" : "" ) + kcl_clock_hours);
			}
		},1000);

		return this;
		
    };
 
 
})( jQuery );