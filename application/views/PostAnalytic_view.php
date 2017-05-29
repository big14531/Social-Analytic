<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	p{
		margin: 0 0 0px;
	}
	label{
		color: black!important;
	}
	.product-description{
	    font-size: 13px;
	}
	.product-title{
		overflow: hidden;
	    text-overflow: ellipsis;
	    display: -webkit-box;
	    line-height: 16px;
	    max-height: 48px;
	    -webkit-line-clamp: 2;
	    -webkit-box-orient: vertical;
	    font-weight: 400!important;
	    color: white;
	    font-size: 13px;
	}
	.products-list .product-info {
	    margin-left: 60px;
	}
	.products-list>.item{
		background: transparent;
		padding-top: 5px;
		padding-bottom: 4px;
		border-bottom: 0px;
	}
	.header-table{
		font-size: 20px;
	}
	.white-text{
		color: white;
	}
	#target_profile_name{
		color: white;
	}
	.dl-horizontal dt{
		width: 100px;
     	text-align: left;
     	color: #8d8d8d; 
	}
	.img-post{
		width: 100%;
	}
	.dl-horizontal dd {
	    margin-left: 100px;
	    text-overflow: ellipsis;
    	overflow: hidden;
    	margin-bottom: 5px;
    	color: white;
	}
	.table-icon{
		width:30px;
		margin: 0px;
	}
	.table-img{
		width:100px;
	}
	.box-font{
		padding-left: 5px;
		padding-top: 5px;
		font-weight: 400;
		font-size: 15px;
		color: black!important;
	}
	.box-font-head{
		font-size: 15px;
		color: black!important;
	}
	.small-box>.inner{
		padding: 5px;
		text-align: center;
	}
	.post-icon{
		margin-bottom: 10px;
		background-color: #f0f0f5;
		border-radius: 5px;
	}
	.modal-dialog{
		padding-top: 15%!important;
	}
	.sk-cube-grid {
		width: 50px;
		height: 50px;
		margin: 100px auto;
	}
	.sk-cube-grid .sk-cube {
		width: 33%;
		height: 33%;
		background-color: #FFF;
		float: left;
		-webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
		animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
	}
	.sk-cube-grid .sk-cube1 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}
	.sk-cube-grid .sk-cube2 
	{
		-webkit-animation-delay: 0.3s;
		animation-delay: 0.3s; 
	}
	.sk-cube-grid .sk-cube3 
	{
		-webkit-animation-delay: 0.4s;
		animation-delay: 0.4s; 
	}
	.sk-cube-grid .sk-cube4 
	{
		-webkit-animation-delay: 0.1s;
		animation-delay: 0.1s; 
	}
	.sk-cube-grid .sk-cube5 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}
	.sk-cube-grid .sk-cube6 
	{
		-webkit-animation-delay: 0.3s;
		animation-delay: 0.3s; 
	}
	.sk-cube-grid .sk-cube7 
	{
		-webkit-animation-delay: 0s;
		animation-delay: 0s; 
	}
	.sk-cube-grid .sk-cube8 
	{
		-webkit-animation-delay: 0.1s;
		animation-delay: 0.1s; 
	}
	.sk-cube-grid .sk-cube9 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}

	@-webkit-keyframes sk-cubeGridScaleDelay {
		0%, 70%, 100% {
			-webkit-transform: scale3D(1, 1, 1);
			transform: scale3D(1, 1, 1);
		} 35% {
			-webkit-transform: scale3D(0, 0, 1);
			transform: scale3D(0, 0, 1); 
		}
	}

	@keyframes sk-cubeGridScaleDelay {
		0%, 70%, 100% {
			-webkit-transform: scale3D(1, 1, 1);
			transform: scale3D(1, 1, 1);
		} 35% {
			-webkit-transform: scale3D(0, 0, 1);
			transform: scale3D(0, 0, 1);
		} 
	}
</style>
<!-- Content Here -->


<div class="content-wrapper">

	<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog" role="document" style="text-align: center;">
			<div class="sk-cube-grid">
				<div class="sk-cube sk-cube1"></div>
				<div class="sk-cube sk-cube2"></div>
				<div class="sk-cube sk-cube3"></div>
				<div class="sk-cube sk-cube4"></div>
				<div class="sk-cube sk-cube5"></div>
				<div class="sk-cube sk-cube6"></div>
				<div class="sk-cube sk-cube7"></div>
				<div class="sk-cube sk-cube8"></div>
				<div class="sk-cube sk-cube9"></div>
			</div>

			<h3 style="color: #FFF">Loading....</h3>
		</div>
	</div>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Post Analytic
		</h1>
	</section>

	<section class="content">  

		<!--  Target Post Zone -->
		<div class="row">
			<div class="col-md-9">
				<!-- Box Comment -->
				<div class="box gray-box">

					<!-- Header  -->
					<div class="box-header with-border">
						<div class="user-block">
							<img class="img-circle" id="target_profile_picture" alt="User Image">
							<span class="username"><a id="target_profile_name" target="_blank"></a></span>
							<span class="description" id="target_create"></span>
							<span class="description" id="target_update"></span>
						</div>
					</div>

					<!-- Body  -->
					<div class="box-body">
						<div class="col-md-3">
							<img class="img-post" id="target_photo" alt="Photo">
						</div>
						
						<div class="col-md-9">
							<dl class="dl-horizontal">

								<dt>ประเภทข่าว</dt>
								<dd id="target_session"></dd>

								<dt>Name</dt>
								<dd id="target_name"></dd>

								<dt>Message</dt>
								<dd id="target_message"></dd>

								<dt>Description</dt>
								<dd id="target_description"></dd>

								<dt>Facebook Link</dt>
								<dd><a id="target_facebook" target="_blank"></a></dd>

								<dt>Content Link</dt>
								<dd><a id="target_link" target="_blank"></a></dd>

							</dl>
								
						</div>	
					</div>

					<!-- Icon -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-4">
								<div class="small-box post-icon">
									<div class="inner">
										<label class="box-font-head">Engagement : </label>
										<label class="box-font" id="target_engagement"></label>
									</div>
								</div>
							</div>

							<div class="col-xs-4">
								<div class="small-box post-icon">
									<div class="inner">
										<label class="box-font-head">Share : </label>
										<label class="box-font" id="target_share"></label>
									</div>
								</div>
							</div>


							<div class="col-xs-4">
								<div class="small-box post-icon">
									<div class="inner">
										<label class="box-font-head">Comment : </label>
										<label class="box-font" id="target_comment"></label>
									</div>
								</div>
							</div>

						</div>
					
					</div>

				</div>
			</div>

			<div class="col-md-3">
				<div class="box gray-box">
					<div class="box-header with-border">
						<p class="white-text">สรุปเปรียบเทียบโพสต์</p>
					</div>

					<!-- Body  -->
					<div class="box-body">
						<ul id="rank-list" class="products-list product-list-in-box">
			                
			            </ul>
					</div>
				</div>
			</div>
		</div>
		


		<!--  Match Post table  -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<p class="header-table">โพสต์ที่เกี่ยวข้อง</p>
					</div>
					<div class="box-body">
						<table id="example1" class="display table table-bordered" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>
<!-- FLOT CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT TIME CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.time.js"></script>
<!-- FLOT RESIZE -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.resize.min.js"></script>

<script>
 
	$(document).ready(function() 
	{
		var page_id = '<?php echo $id['page_id']; ?>';
		var post_id = '<?php echo $id['post_id']; ?>';
		var keyword = decodeURIComponent( '<?php echo $id['keyword'];?>' ).split(" ");
		$('#myModal').modal('show')
		$.ajax(
		{
			url:  "<?php echo(base_url());?>ajaxAnalyticPost",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
				'post_id': post_id, 
				'page_id': page_id,
				'keyword': keyword
			},
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				console.log(data);
				var match_sort = data.match_post.sort(function(a,b){return b[0]['engage']-a[0]['engage']});
				createPostTarget( data.target_post );
				createRankList( match_sort , data.target_post[0].engage );
				createTable( data.target_post );
				renderTable( match_sort );
				toggleColumnReaction();

				$('#myModal').modal('hide');
			}   
		}
		);      
	}
	);

	function createRankList( data , target_engage ) 
	{
		var rank_obj = $("#rank-list");

		for (var i = 0; i < 5; i++) 
		{

			var post = data[i][0];
			var html = 	'<li class="item">'+
							'<div class="product-img">'+
								'<img src="'+post.page_picture+'">'+
		                  	'</div>'+
							'<div class="product-info">'+
		                    	'<a href="'+post.permalink_url+'" class="product-title" target="_blank">'+post.message+'</a>'+
		                        '<span class="product-description">'+
		                          'Engagement :'+parseInt(post.engage).toLocaleString('en-US')+
		                        '</span>'+
							'</div>'+
		                '</li>'
			rank_obj.append(html);
		}
	}

	function generateData ( data , color ) 
	{
		var result =[];
		var label =[];
		for (var i = 0; i < data.length; i++)
		{
			value = data[i][0];
			var text = [
			value.name,
			value.page_name,
			value.page_id,
			value.post_id,
			value.picture
			];

			result.push( [ value.shares , value.interact ] );
			label.push( {label: text } );
		}

		var fan_dataset = 
		{
			data: result,
			color: color,
			label: "Post",   
			extraData: label
		};
		return fan_dataset;
	}

	function generateDataTarget ( data , color ) 
	{
		var result =[];
		var label =[];
		value = data[0];
		var text = [
		value.name,
		value.page_name,
		value.page_id,
		value.post_id,
		value.picture
		];

		result.push( [ value.shares , value.interact ] );
		label.push( {label: text } );

		var fan_dataset = 
		{
			data: result,
			color: color,
			label: "Post",   
			extraData: label
		};
		return fan_dataset;
	}

	function toggleColumnReaction()
	{
		// Get the column API object
        var table = $('#example1').DataTable();

        var column_likes = table.column( 10 ).visible();
        var column_love = table.column( 11 ).visible();
        var column_wow = table.column( 12 ).visible();
        var column_haha = table.column( 13 ).visible();
        var column_sad = table.column( 14 ).visible();
        var column_angry = table.column( 15 ).visible();

		// Hide a column
		table.column( 10 ).visible( !column_likes );
		table.column( 11 ).visible( !column_love );
		table.column( 12 ).visible( !column_wow );
		table.column( 13 ).visible( !column_haha );
		table.column( 14 ).visible( !column_sad );
		table.column( 15 ).visible( !column_angry );		
	}

	function createPostTarget( data ) 
	{
		var engagement = parseInt (data[0].likes )+ 
		parseInt (data[0].love )+ 
		parseInt (data[0].wow )+ 
		parseInt (data[0].haha )+ 
		parseInt (data[0].sad )+  
		parseInt (data[0].angry )+ 
		parseInt (data[0].shares )+
		parseInt (data[0].comments );    

		$('#target_profile_picture').attr( 'src', data[0].page_picture );
		$('#target_profile_name').text( data[0].page_name );
		$('#target_profile_name').attr( 'href', data[0].page_link );
		$('#target_create').text( 'Shared publicly - '+data[0].created_time );
		$('#target_update').text( 'Lated update - '+data[0].last_update_time );
		$('#target_photo').attr( 'src' , data[0].picture );

		$('#target_session').text( data[0].session===null?'None':data[0].session );
		$('#target_name').text( data[0].name );
		$('#target_message').text( data[0].message );
		$('#target_description').text( data[0].description );

		$('#target_facebook').attr( 'href' , data[0].permalink_url );
		$('#target_facebook').text( data[0].permalink_url );
		$('#target_link').attr( 'href' , data[0].link );
		$('#target_link').text( data[0].link );

		$('#target_engagement').text( engagement.toLocaleString('en-US') );
		$('#target_share').text( data[0].shares.toLocaleString('en-US') );
		$('#target_comment').text( data[0].comments.toLocaleString('en-US') );
		$('#target_like').text( data[0].likes.toLocaleString('en-US') );
		$('#target_love').text( data[0].love.toLocaleString('en-US') );
		$('#target_wow').text( data[0].wow.toLocaleString('en-US') );
		$('#target_smile').text( data[0].haha.toLocaleString('en-US') );
		$('#target_sad').text( data[0].sad.toLocaleString('en-US') );
		$('#target_angry').text( data[0].angry.toLocaleString('en-US') );
	}

	function renderTable(data)
	{
		datatable = $('#example1').DataTable();
		datatable.clear().draw();
		datatable.rows.add( data ); // Add new data
		datatable.columns.adjust().draw(); // Redraw the DataTable
	}

	function convertTime( data )
	{ 
		var temp_date = data.substr(0,10);
		var date = temp_date.split("-");
		var time = data.substr(11);
		var result = date[2]+"-"+date[1]+"-"+date[0]+" "+time;
		return result;
	}

	function renderTable(data)
	{
		var dataset=[];
		for ( var key in data )
		{
			var value = data[key][0];
			var score = data[key].count;
			var engagement =  parseInt (value.comments)+
			parseInt (value.likes )+ 
			parseInt (value.love )+ 
			parseInt (value.wow )+ 
			parseInt (value.haha )+ 
			parseInt (value.sad )+  
			parseInt (value.angry )+ 
			parseInt (value.shares );

			var reaction =     parseInt (value.likes )+ 
			parseInt (value.love )+ 
			parseInt (value.wow )+ 
			parseInt (value.haha )+ 
			parseInt (value.sad )+  
			parseInt (value.angry );

			var analytic_link = "<?php echo base_url() ?>"+"postAnalytic/"+value.page_id+"/"+value.post_id;

			var created_time = convertTime( value.created_time );
			var last_update_time = convertTime( value.last_update_time );
			dataset[key] = 
			[
			score,
			value.picture,
			created_time,
			last_update_time,
			value.name,
			value.page_name,
			engagement,
			value.shares,
			value.comments,
			reaction,
			value.likes,
			value.love,
			value.wow,
			value.haha,
			value.sad,
			value.angry,
			value.link,
			value.permalink_url ,
			analytic_link
			];

		}

		datatable = $('#example1').DataTable();
		datatable.clear().draw();
		datatable.rows.add( dataset ); // Add new data
		datatable.columns.adjust().draw(); // Redraw the DataTable
	}

	function createTable( data ) {

		var target_like = data[0].likes;
		var target_love = data[0].love;
		var target_wow = data[0].wow;
		var target_haha = data[0].haha;
		var target_sad = data[0].sad;
		var target_angry = data[0].angry;
		var target_shares = data[0].shares;
		var target_comments = data[0].comments;

		var reaction = parseInt (data[0].likes )+ 
		parseInt (data[0].love )+ 
		parseInt (data[0].wow )+ 
		parseInt (data[0].haha )+ 
		parseInt (data[0].sad )+  
		parseInt (data[0].angry );

		var engagement = reaction+ 
		parseInt (data[0].shares )+
		parseInt (data[0].comments );

		
		var more_color = 'green';
		var less_color = '#f6546a';
		$('#example1').DataTable( 
		{
			columns: [
			{ title: "Score" },
			{ title: "Image" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				$(nTd).html("<image class='table-img' src='"+sData+"' />");
			}},
			{ title: "Publish time" },
			{ title: "Update time" },
			{ title: "Name" },
			{ title: "Page" },
			{ title: "Engagement",
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = engagement - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( engagement ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( engagement ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "Share" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_shares - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_shares ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_shares ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "Comments" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_comments - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_comments ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_comments ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "Reaction" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = reaction - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( reaction ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( reaction ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/like.png'>",
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_like - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_like ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_like ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/love.png'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_love - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_love ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_love ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/wow.png'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_wow - sData;				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_wow ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_wow ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/smile.png'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_haha - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_haha ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_haha ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/sad.png'>"  ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_sad - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_sad ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_sad ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/angry.png'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

				var diff = target_angry - sData;
				diff = diff.toLocaleString('en-US');

				if ( parseInt( sData ) > parseInt( target_angry ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-down" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', less_color);
				}
				else if ( parseInt( sData ) < parseInt( target_angry ) ) 
				{
					$(nTd).html(sData.toLocaleString('en-US')+' <i class="fa fa-caret-up" aria-hidden="true"></i> ('+diff+')'); 
					$(nTd).css('color', more_color );
				}
				else
				{
					$(nTd).html(sData.toLocaleString('en-US') +'( '+diff+' )'); 
				}
			}},
			{ title: "<i class='fa fa-globe' aria-hidden='true'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				$(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
			}},
			{ title: "<i class='fa fa-facebook-official' aria-hidden='true'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				$(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
			}},
			{ title: "<i class='fa fa-line-chart' aria-hidden='true'>" ,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				$(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-line-chart' aria-hidden='true'></a>");
			}},
			],
            "iDisplayLength": 20,
			order: [[ 0, "desc" ]]
		} 
		);
}
	// ajaxCall(  page_id , date[0] , date[1] );

</script>

</body>
</html>
