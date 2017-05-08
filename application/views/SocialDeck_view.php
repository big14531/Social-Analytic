<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu') ?>


<!-- Internal CSS Zone -->
<style>

	html,body{ margin:0; padding:0; height:100%; width:100%; }
	.page-name{
		margin-right: 5px;
	}
	.content{
		padding: 0px;
		padding-left: 10px;
		padding-right: 30px;
		margin:0px;
	}	
	.page-logo{
		width: 40px;
		margin-right: 10px; 
	}
	.gray-box{
		margin: 5px;
		overflow:hidden;
	}
	.box-header{
		background-color: #222d32;
	}
	.box-body{
		height: 100%;
		padding-right: 0px;
	}
	.feed-col{
		padding-right: 0px;
		padding-left:5px;
		height: 100%!important;
	}
	.mCSB_inside>.mCSB_container{
		margin-right:0px!important;
	}
	.page-btn,.page-btn:hover, .page-btn:active, .page-btn:focus{
		background-color: transparent;
		border: none;
		color: white;
	}

</style>

<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=3">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/jquery.mCustomScrollbar.min.css">

<!-- Content Zone -->
<div class="content-wrapper">

	<section class="content"> 
		<div class="row">
			<?php for ($i=0; $i < 4 ; $i++) { ?>
			<div class="col-xs-3 feed-col" id="col-<?=$i?>">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" id="page-logo-<?=$i?>">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle page-btn" data-toggle="dropdown">
								<span id="page-name-<?=$i?>" class="page-name"></span><span class="caret"></span>
							</button>
							<ul class="dropdown-menu" id="page-list-<?=$i?>">
							</ul>
						</div>
					</div>
					<div class="box-body">
						<ul class="list-box mCustomScrollbar" id="list-box-<?=$i?>">

							<li>
								<a href="#" class="user-pic"><img src="images/thaipbs.jpg" alt=""></a>
								<div class="list-right">
									<p class="list-name">Username<span class="list-date">11/11/2017</span></p>
									<div class="list-txt">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									</div>

									<div class="list-social">
										<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>10</span></div>
										<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>20</span></div>
										<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>100</span></div>
									</div>
								</div>
							</li>

						</ul>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>
<script src="<?php echo(base_url());?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

	function createPageCard( data ) 
	{
		for (var i = 0; i < 4; i++) 
		{
			var page_obj = data[i];
			var object = $("#col-"+i);

			var page_name_obj = $("#page-name-"+i);
			var page_logo_obj = $("#page-logo-"+i);
			var page_list_obj = $("#page-list-"+i);

			page_name_obj.text( page_obj.name );
			page_logo_obj.attr( 'src' ,page_obj.picture );

			for (var j = 0; j < data.length; j++) 
			{
				var inner_object = data[j];
				var html = "<li><a>"+inner_object.name+"</a></li>";
				page_list_obj.append( html );
			}
		}
	}

	function createNewPost( data ) 
	{
		// body...
	}

	function UpdatePost( data ) 
	{
		// body...
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
					createPageCard(data);
				}
			});
	}

	function ajaxGetNewPost()
	{		
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetNewPost",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				success:function(data)
				{
					createNewPost(data);
				}
			});
	}

	function ajaxUpdatePost()
	{		
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxUpdatePost",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'post_array': post_array
				},
				success:function(data)
				{
					UpdatePost(data);
				}
			});
	}

	$(document).ready(function() 
	{
		var box_height = $(document).height();
		$(".gray-box").height( box_height-60 );

		ajaxCreatePageCard();
		setInterval(function(){ 
			console.log("Hello"); 
		}, 1000);


	});

</script>

</body>
</html>