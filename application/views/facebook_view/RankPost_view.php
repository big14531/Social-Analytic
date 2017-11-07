<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<style>
	li{
		color:black!important;
	}
	.btn{
		border-radius: 30px;
	}
	.social-icon {
		display: inline-block;
		margin: 0px 7px;
		color: #83c8f7;
    }
	li.header{
	}
	.full-width{
		width:100%;
	}
	.graph-box{
		padding: 20px;
	}
	.table-img{
		width:30px;
	}
	.list-social{
		font-size: 0.8em;
    }
	.page-icon{
		float: left;
		width: 40px;
		border-radius: 5px;
	}
	.box-header{
		color:#b8c7ce;
		text-align: center;
	}
	.page-name{
		text-overflow: ellipsis;
		width: 75%;
		overflow: hidden;
		font-size: 1.25em;
		padding: 7px 40px;
		padding-left: 70px;
		white-space: nowrap;
		margin: 0px;
		float: left;
		font-weight: 300;
	}
	.box-body {   
		padding-bottom: 0px;
	}
	.box-content{
    	padding:0px;
	}
	.btn-choose{
		color: #222d32;
	}
	.page-list{
		padding: 10px;
		padding-right: 10px;
		background-color: gray;
		background-color: #1a2226;
		border-top: 1px solid #4b4b4b;
		height: 80px;
	}
	.ranking-number{
		color: white;
		padding: 5px;
		font-size: 15px;
		text-align: center;
		float: left;
		height: 30px;
		width: 30px;
		border-radius: 50%;
		margin-top: 10px;
	}
	.best.ranking-number{
		background-color: #008d4c;		
	}
	.worst.ranking-number{
		background-color: #c9302c;		
	}
	.post-detail{
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 8px;
		float: left;
		width: 70%;
	}
	.post-img{
		float: right;
		max-width: 50px;
		max-height: 50px;
		border-radius: 5px;
	}
	.black-box{
		background-color: #222d32!important;
		border-top: 0px!important;
		color: #b8c7ce!important;
	}
	.detail-text{
		margin: 0px;
		padding: 5px 0px;
		font-size: 15px;
		color: #efefef;
		font-weight: 300;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	.date-text{
		font-size: 14px;
		font-style: italic;
		display: inline-block;
		float: right;
	}
	.detail-box{
		margin: 0px;
		margin-right:10px; 
		float: left;
	}
	.table-icon{
		width:20px;
	}
	.control-box{
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.list-date{
		font-style: italic;
		font-weight: 400;
		font-size: 12px;
		float: right;
	}
	.collapse-btn{
		margin-top: 8px;
		width: 30px;
		height: 30px;
		padding: 0;
	}
	.card-body{
		padding:0px;
	}
</style>


<!-- Content Here -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1 style="float:left;margin-right: 20px;">
			จัดอันดับโพสต์
		</h1>
		<!-- button row -->
		<div class="row control-row">
		</div>

	</section>

	<section class="content">   

		<div id='alert' class="alert alert-dismissible hidden">
			<h3>Success!!</h3> 
			<p>This is a green alert.</p>
		</div>

		<div class="box gray-box control-box">
			<div class="box-body">
				<div class="row control-row">
					<div class="col-md-2">
						<div class="input-group full-width">
							<button type="button" class="selectpicker btn btn-md btn-default full-width" id="daterange-btn">
								<span>
									<i class="fa fa-calendar"></i> เลือกวันที่
								</span>
								<i class="fa fa-caret-down"></i>
							</button>
						</div>
					</div>
					<div class="col-md-3">
						<select id="page-selector" class="form-control select2 selector" multiple="multiple" data-placeholder="เลือกเพจ" style="width: 100%;">
						</select>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<button type="button" class="btn btn-md btn-info full-width" id="search-btn">
								<span>
									<i class="fa fa-calendar"></i> ค้นหา
								</span>
							</button>
						</div>
					</div>	
					<div class="col-md-2">
						<div class="form-group">
							<button type="button" class="btn btn-md btn-success full-width" id="best-btn">
								<span>
									<i class="fa fa-thumbs-up"></i> อันดับดีที่สุด
								</span>
							</button>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<button type="button" class="btn btn-md btn-danger full-width" id="worst-btn">
								<span>
									<i class="fa fa-thumbs-down"></i> อันดับแย่ที่สุด
								</span>
							</button>
						</div>
					</div>			
				</div>
			</div>
		</div>
	
		<div class="row card-row" id="card-row">
		</div>

	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<script>

	function createEmptyBoxPage( data ) 
	{
		for (var i = 0; i < data.length; i++) 
		{
			var page_data = data[i];
			var icon = page_data.picture;
			var page_name = page_data.name;

			var card_id = "card_"+page_data.page_id;
			var box_id = "box_"+page_data.page_id;
			var content_id = "content_"+page_data.page_id;

			// Create Card in Row
			var main_row = $("#card-row");
			main_row.append('<div class="col-md-4" id="'+card_id+'" page-name="'+page_name+'"></div>');

			// Create Box in Card
			var main_card = $("#"+card_id);
			main_card.append('<div class="box gray-box" id="'+box_id+'"></div>');

			var box_card = $("#"+box_id);

			var html = '<div class="box-header">'+
						'<img class="page-icon" src="'+icon+'">'+
						'<span class="page-name">'+page_name+'</span>'+
						'<button type="button" class="btn btn-primary btn-sm pull-right collapse-btn" data-widget="collapse" data-toggle="box-body" title="Collapse">'+
						'<i class="fa fa-plus"></i>'+
						'</button>'+
						'</div>'+
						'<div class="box-body">'+
						'<div id="best_'+content_id+'" class="best-box box-content"></div>'+
						'<div id="worst_'+content_id+'" class="worst-box box-content" style="display:none;!important"></div>'+
						'</div>';

			box_card.append( html );
		}
	}

	function createSelector( data ) 	
	{
		// Create Card in Row
		var selector = $("#page-selector");

		for (var i = 0; i < data.length; i++) 
		{
			var page_data = data[i];
			var page_name = page_data.name;
			var page_id = page_data.page_id;
			selector.append('<option>'+page_name+'</option>');
		}
	}

	function addContent( key , post_data , type )
	{

		var content_id = type+"_content_"+post_data.page_id;
		var box_content_id = "box_"+content_id+"_"+key;
		var content = $("#"+content_id);


		var name 			= post_data.name;
		var created_time	= post_data.created_time;
		var engage 			= post_data.engage;
		var description 	= post_data.description;
		var message 		= post_data.message;
		var comments 		= post_data.comments;
		var picture 		= post_data.picture;
		var likes 			= post_data.likes;
		var love 			= post_data.love;
		var wow 			= post_data.wow;
		var haha 			= post_data.haha;
		var sad 			= post_data.sad;
		var angry 			= post_data.angry;
		var shares 			= post_data.shares;
		var link 			= post_data.link;
		var permalink_url 	= post_data.permalink_url;

		var html_box = '<div class="col-xs-12 page-list">'+
							'<div class="box black-box" id="'+box_content_id+'">'+
							'<div class="'+type+' ranking-number">'+key+'</div>'+
							'<a href="'+permalink_url+'" target="_blank"><img class="post-img" src="'+picture+'"/></a>'+
							'</div>'+
						'</div>';
		content.append( html_box );

		var box_content = $("#"+box_content_id);
		var html = 
		"<div class='post-detail col-xs-8'>"
		+"<p class='detail-text'>"+name+"</p>"

		+'<div class="list-social">'
		+'<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span  class="post-number" id="engage_number"> '+parseInt(engage).toLocaleString('en-US')+'</span></div>'
		+'<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span  class="post-number" id="comment_number"> '+parseInt(comments).toLocaleString('en-US')+'</span></div>'
		+'<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span  class="post-number" id="share_number"> '+parseInt(shares).toLocaleString('en-US')+'</span></div>'
		+'<span class="list-date">'+created_time.substr(0,10)+'</span>'
		+'</div>'

		
		box_content.append( html );
	}

	function editBoxPage( data ) 
	{
		$(".box-content").empty();
		for (var i = 0; i < data[0].length; i++) 
		{
			var best_list = data[0][i];
			var worst_list = data[1][i];

			for ( var key in best_list )
			{
				var best_post = best_list[key];
				var worst_post = worst_list[key];

				addContent( parseInt(key)+1 ,best_post , 'best' );
				addContent( parseInt(key)+1 ,worst_post , 'worst' );

			}
			
		}
	}

	function ajaxRankPost( min_date , max_date )
	{
		$('#search-btn').find('span').text('Searching.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true);
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxRankPost",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
				'min_date': min_date, 
				'max_date': max_date
			},
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				if (data.length != 0) 
				{
					$('#alert').removeClass( 'alert-warning');
					$('#alert').addClass( 'alert-success');
					$('#alert').find('h3').text( "ค้นหาสำเร็จ!!" );
					$('#alert').find('p').text('');
					$('#alert').removeClass( 'hidden');
					editBoxPage(data);
					console.log(data);
				}
				bestButtonCallback();
				$('#search-btn').prop('disabled',false);
				$('#search-btn').removeClass('disabled');
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> Search');
			},
			error:function(xhr, textStatus, errorThrown) 
			{
				$('#search-btn').prop('disabled',false);
				$('#alert').removeClass( 'alert-info');
				$('#alert').removeClass( 'alert-success');
				$('#alert').addClass( 'alert-danger');
				$('#alert').find('h3').text( "Error!!" );
				$('#alert').find('p').text( textStatus+" "+errorThrown+" "+xhr );
			}   
		});
	}

	function ajaxCreatePageCard()
	{		
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxGetActivePage",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				createSelector(data);
				createEmptyBoxPage(data);
			}
		});
	}

	function updateFloatWidget()
	{
		$("#card-row > div").each(function(i){

			if(i%2<=0){
				$(this).removeClass('pull-right');
				$(this).addClass('pull-left');
			}else{
				$(this).removeClass('pull-left');
				$(this).addClass('pull-right');
			}
		});

	}

	function bestButtonCallback() 
	{
		$(".worst-box").css('display','')
		$(".best-box").prop('hidden',false);
		$(".worst-box").prop('hidden',true)
	}

	function worstButtonCallback() 
	{
		$(".best-box").css('display','')
		$(".best-box").prop('hidden',true);
		$(".worst-box").prop('hidden',false);
	}

	$(document).ready(function() 
	{
		ajaxCreatePageCard();
		$(".select2").select2();

		$('#daterange-btn').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
		}, 
		function(start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		});

		$('#best-btn').click(function()
		{	
			bestButtonCallback();
		});

		$('#worst-btn').click(function()
		{	
			worstButtonCallback();
		});

		$('#search-btn').click(function()
		{
			var date_range = $('#daterange-btn').val();
			var date = date_range.split(' to ');

			if ( Boolean(date_range) ) 
			{
				ajaxRankPost( date[0] , date[1] );
			}
			else
			{
				$('#alert').removeClass( 'alert-info');
				$('#alert').removeClass( 'hidden');
				$('#alert').removeClass( 'alert-success');
				$('#alert').removeClass( 'alert-warning');
				$('#alert').addClass( 'alert-warning');
				$('#alert').find('h3').text( "กรุณาเลือกวันที่และชื่อเพจที่ต้องการ" );
				$('#alert').find('p').text( '' );
			}
			$("#alert").fadeTo(2000, 500).slideUp(500, function()
			{
				$("#alert").slideUp(500);
			});
		});

		$('.box').on('hidden.bs.collapse', function (e) {
			alert('Event fired on #' + e.currentTarget.id);
		})

		$('#page-selector').change(function(){



			var selected_page = $('#page-selector').val();
			$("#card-row > div").each(function(){

				var is_true = selected_page.includes( $(this).attr('page-name') );

				if ( is_true )
				{
					$(this).css("display","block");
				}
				else
				{
					$(this).css("display","none");
				}

			});

			updateFloatWidget();

		});
	});

</script>

</body>
</html>
