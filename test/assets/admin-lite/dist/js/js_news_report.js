$(function(){
		chkShowFrmSummaryNews();
		chkShowFrmTopNews();
		//--------------------------------------
		$('#btn_export').click(function(){
			error=chk_frm();
			if(error==0){
				$('#hidden_export').val(1);
				$('#form_news_report').submit();
			}
		});
		$('#btn_export_top_news').click(function(){
			error=chk_frm_top_news();
			if(error==0){
				$('#hidden_export_top_news').val(1);
				$('#form_news_report_top_news').submit();
			}
		});
		$('#btn_ok').click(function(){
			error=chk_frm();
			if(error==0){
				$('#hidden_export').val(0);
				$('#form_news_report').submit();
			}
		});
		$('#btn_ok_top_news').click(function(){
			error=chk_frm_top_news();
			if(error==0){
				$('#hidden_export_top_news').val(0);
				$('#form_news_report_top_news').submit();
			}
		});
		$('#rb_year').click(function(){
			chkShowFrmSummaryNews();
		});
		$('#rb_day').click(function(){
			chkShowFrmSummaryNews();
		});
		$('#rb_range').click(function(){
			chkShowFrmSummaryNews();
		});
		// top news
		$('#rb_range_top_news').click(function(){
			chkShowFrmTopNews();
		});
		$('#rb_day_top_news').click(function(){
			chkShowFrmTopNews();
		});
		$('#rb_month_top_news').click(function(){
			chkShowFrmTopNews();
		});
	});

	function chkShowFrmSummaryNews(){
		if($('#rb_year').is(':checked')==true){
			
			$('#frm_day,#frm_range').hide();
			$('#frm_year').show();
		}else if($('#rb_day').is(':checked')==true){
			
			$('#frm_year,#frm_range').hide();
			$('#frm_day').show();
		}else{
			
			$('#frm_range').show();
			$('#frm_day,#frm_year').hide();
		}
	}

	function chkShowFrmTopNews(){
		if($('#rb_month_top_news').is(':checked')==true){
			$('#frm_range_top_news,#frm_day_top_news').hide();
			$('#frm_month_top_news').show();
		}else if($('#rb_day_top_news').is(':checked')==true){
			$('#frm_month_top_news,#frm_range_top_news').hide();
			$('#frm_day_top_news').show();
		}else{
			$('#frm_day_top_news,#frm_month_top_news').hide();
			$('#frm_range_top_news').show();
		}
	}
	function chk_frm(){
		error=0;
			if($('#rb_year').is(':checked')==true){
				if($('#cmb_year').val()==0 ){
					alert('กรุณาระบุปีด้วยครับ');
					error++;
				}
			}else if($('#rb_day').is(':checked')==true){
				if($('#txt_date_search').val()=='' ){
					alert('กรุณาระบุวันที่ด้วยครับ');
					error++;
				}
			}else{
				if($('#txt_date_start').val()=='' || $('#txt_date_end').val()=='' ){
					alert('กรุณาระบุวันที่ด้วยครับ');
					error++;
				}
			}
			return error;
	}
	function chk_frm_top_news(){
		error=0;
			if($('#rb_month_top_news').is(':checked')==true){
				if($('#cmb_year_top_news').val()==0){
					alert('กรุณาเลือกปี และเดือนด้วยครับ');
					error++;
				}
			}else if($('#rb_day_top_news').is(':checked')==true){
				if($('#txt_date_search_top_news').val()=='' ){
					alert('กรุณาระบุวันที่ด้วยครับ');
					error++;
				}
			}else{
				if($('#txt_date_start_top_news').val()=='' || $('#txt_date_end_top_news').val()=='' ){
					alert('กรุณาระบุวันที่ด้วยครับ');
					error++;
				}
			}
			return error;
	}