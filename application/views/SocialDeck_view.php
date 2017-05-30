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
		padding-left: 0px;
		padding-bottom: 50px;
	}
	.feed-col{
		padding-right: 0px;
		padding-left:5px;
		height: 100%!important;
	}
	.mCSB_inside>.mCSB_container{
		margin-right:10px!important;
	}
	.select2-container--default .select2-selection--single{
		background-color: transparent!important;
	}
	.select2-selection__rendered{
		color: #fff!important;
		
	}
	.page-btn,.page-btn:hover, .page-btn:active, .page-btn:focus{
		background-color: transparent;
		border: none;
		color: white;
	}
	.list-txt{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		line-height: 16px;     /* fallback */
		max-height: 48px;      /* fallback */
		-webkit-line-clamp: 3; /* number of lines to show */
		-webkit-box-orient: vertical;			
	}
	.highlight-post{
		background-color: #3c8dbc;
	}
	.blink-item{
		-moz-transition:all 0.5s ease-in-out;
	    -webkit-transition:all 0.5s ease-in-out;
	    -o-transition:all 0.5s ease-in-out;
	    -ms-transition:all 0.5s ease-in-out;
	    transition:all 0.5s ease-in-out;
	    -moz-animation:blink normal 1.5s infinite ease-in-out;
	    /* Firefox */
	    -webkit-animation:blink normal 1.5s infinite ease-in-out;
	    /* Webkit */
	    -ms-animation:blink normal 1.5s infinite ease-in-out;
	    /* IE */
	    animation:blink normal 1.5s infinite ease-in-out;
	    /* Opera */
	}
	.white{
		color: white!important;
	}
	.highlight-txt{
		margin-left: 20px;
	    margin-bottom: 15px;
	    font-weight: 400;
	    margin-top: -5px;
	    color: rgb(255, 255, 255);
	    font-size: 15px;
	    text-decoration: underline;
	}

	@keyframes blink 
	{
	    0% {
	           background-color: #222d32;
	    }
	    50% {
	           background-color: #a8a8a8;
	    }
	    100% {
	           background-color: #222d32;
	    }
	}
	@-webkit-keyframes blink 
	{
	    0% {
	           background-color: #222d32;
	    }
	    50% {
	           background-color: #a8a8a8;
	    }
	    100% {
	           background-color: #222d32;
	    }
	}

</style>

<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=5">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/jquery.mCustomScrollbar.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<!-- Content Zone -->
<div class="content-wrapper">

	<section class="content"> 
		<div class="row">
			<?php for ($i=0; $i < 4 ; $i++) { ?>
			<div class="col-xs-3 feed-col" id="col-<?=$i?>">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" id="page-logo-<?=$i?>">
						<select class="js-example-basic-single" id="selector-<?=$i?>">
						</select>
					</div>
					<div class="box-body mCustomScrollbar">
						<ul class="list-box" id="list-box-<?=$i?>">
							
							<li class="highlight-post" id="highlight-post-<?=$i?>"> 
								<div class="highlight-txt">ข่าวฮิตในช่วงครึ่งชั่งโมง</div>
								
								<a target="_blank" href="#" class="user-pic" id="highlight-link-<?=$i?>"><img id="highlight-pic-<?=$i?>" ></a> 
								<div class="list-right"> 
									<p id="highlight-name-<?=$i?>" class=" list-name"><span id="highlight-txt-<?=$i?>"></span><span id="highlight-date-<?=$i?>" class="white list-date"></span></p> 
									<div id="highlight-description-<?=$i?>" class="list-txt"></div> 

									<div class="list-social"> 
										<div class="white like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span id="highlight-like-<?=$i?>"></span></div> 
										<div class="white comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span id="highlight-comment-<?=$i?>"></span></div> 
										<div class="white shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span id="highlight-shared-<?=$i?>"></span></div> 
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
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo(base_url());?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

	var last_time_update = []; 

	function setHightlightOrder()
	{
		$("#list-box-"+0+" li:eq(0)").before($("#highlight-post-"+0));
		$("#list-box-"+1+" li:eq(0)").before($("#highlight-post-"+1));
		$("#list-box-"+2+" li:eq(0)").before($("#highlight-post-"+2));
		$("#list-box-"+3+" li:eq(0)").before($("#highlight-post-"+3));
	}

	function appendPost( post , col ) 
	{
		var list_box = $("#list-box-"+col);
		var html =  '<li id="post-'+post.page_id+"_"+post.post_id+'" class="post-item">'
		+'<a href="'+post.permalink_url+'" class="user-pic" target="_blank"><img src="'+post.picture+'" alt=""></a>'
		+'<div class="list-right">'
		+'<a href="'+post.permalink_url+'" class="list-name" target="_blank">'
		+'<p class="list-name">'+post.name+'<span class="list-date">'+post.created_time+'</span></p>'
		+'</a>'
		+'<div class="list-txt">'
		+post.message	
		+'</div>'

		+'<div class="list-social">'
		+'<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span id="engage_number">'+post.engage+'</span></div>'
		+'<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span id="comment_number">'+post.comments+'</span></div>'
		+'<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span id="share_number">'+post.shares+'</span></div>'
		+'</div>'
		+'</div>'
		+'</li>'
		list_box.append( $(html).hide().fadeIn(500) );
	}

	function prependPost( post , col ) 
	{
		var list_box = $("#list-box-"+col);
		var html =  '<li id="post-'+post.page_id+"_"+post.post_id+'" class="post-item">'
		+'<a href="'+post.permalink_url+'" class="user-pic" target="_blank"><img src="'+post.picture+'" alt=""></a>'
		+'<div class="list-right">'
		+'<a href="'+post.permalink_url+'" class="list-name" target="_blank">'
		+'<p class="list-name">'+post.name+'<span class="list-date">'+post.created_time+'</span></p>'
		+'</a>'
		+'<div class="list-txt">'
		+post.message	
		+'</div>'

		+'<div class="list-social">'
		+'<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>'+post.engage+'</span></div>'
		+'<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>'+post.comments+'</span></div>'
		+'<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>'+post.shares+'</span></div>'
		+'</div>'
		+'</div>'
		+'</li>'
		list_box.prepend( $(html).hide().fadeIn(500)  );
		$('#post-'+post.page_id+'_'+post.post_id).addClass('blink-item');
	}

	function addNewPost( data ) 
	{
		for (var col = 0; col < data.length; col++) 
		{

			var post_list = data[col];
			if ( post_list.length==0 ) 
			{
				continue;
			}

			for (var key = 0; key < post_list.length; key++) {
				var post = post_list[key];
				prependPost( post , col );
			}
			last_time_update[col] = post_list[0].created_time;
		}
	}

	function createPageCard( data ) 
	{
		var result=[];
		for (var i = 0; i < data.length; i++) 
		{
			var name = data[i].name;
			var page_id = data[i].page_id;
			result.push( { id: page_id, text: name} );
		}
		
		$(".js-example-basic-single").select2({
			data: result
		});

		for (var i = 0; i < 4; i++) 
		{
			var page_obj = data[i];
			var object = $("#col-"+i);
			var selector = $("#selector-"+i);
			selector.val( page_obj.page_id ).trigger("change");
			var page_logo_obj = $("#page-logo-"+i);
			page_logo_obj.attr( 'src' ,page_obj.picture );
		}
	}

	function createFirstTimePost( data ) 
	{
		for (var col = 0; col < data.length; col++) 
		{
			var post_list = data[col];
			for (var key = 0; key < post_list.length; key++) 
			{
				var post = post_list[key];
				appendPost( post , col );
			}
			last_time_update[col] = post_list[0].created_time;
		}	
	}

	function noHighlight( key ) 
	{
		$("#highlight-txt-"+key).text( ' no highlight '  );
		$("#highlight-link-"+key).attr( 'href' , '#'  );
		$("#highlight-pic-"+key).attr( 'src' , '#'  );
		$("#highlight-date-"+key).text( '' );
		$("#highlight-description-"+key).text( '' );
		$("#highlight-like-"+key).text( '' );
		$("#highlight-comment-"+key).text( '' );
		$("#highlight-shared-"+key).text( '' );
	}

	function editHighlightPost( data ) 
	{	
		for (var key = 0; key < data.length; key++) 
		{
			var value = data[key][0];
			if( typeof(value)==='undefined' )
			{
				noHighlight(key);
				continue;
			} 
			$("#highlight-txt-"+key).text( value.name  ).hide().fadeIn(500);
			$("#highlight-link-"+key).attr( 'href' , value.permalink_url  ).hide().fadeIn(500);
			$("#highlight-pic-"+key).attr( 'src' , value.picture  ).hide().fadeIn(500);
			$("#highlight-date-"+key).text( value.last_update_time  ).hide().fadeIn(500);
			$("#highlight-description-"+key).text( value.message ).hide().fadeIn(500);
			$("#highlight-like-"+key).text( value.engage ).hide().fadeIn(500);
			$("#highlight-comment-"+key).text( value.comments ).hide().fadeIn(500);
			$("#highlight-shared-"+key).text( value.shares ).hide().fadeIn(500);
		}
	}

	function editOneNewPost( data , target ) 
	{
		$("#list-box-"+target+" li:not(:first)").remove();		
		for (var key = 0; key < data.length; key++) 
		{
			var post = data[key];
			appendPost( post , target );
		}
	}

	function editBoxHead( data , target ) 
	{
		var page_logo_obj = $("#page-logo-"+target);
		page_logo_obj.attr( 'src' ,data[0].picture );
	}

	function updatePost( data ) 
	{
		for (var i = 0; i < data.length; i++) {
			var post = data[i];
			var target = $("#post-"+post.id);
			if ( typeof( post )=='string' ) continue;
			if( typeof (post.reaction.summary.total_count) !== 'undefined' )
			{
				$("#post-"+post.id).find( "#engage_number" ).text( post.reaction.summary.total_count ).hide().fadeIn(500);
			}

			if( typeof (post.comments.summary.total_count) !== 'undefined' )
			{
				$("#post-"+post.id).find( "#comment_number" ).text( post.comments.summary.total_count ).hide().fadeIn(500);
			}

			if( typeof (post.shares) !== 'undefined' )
			{
				$("#post-"+post.id).find( "#share_number" ).text( post.shares.count ).hide().fadeIn(500);
			}
		}
	}

	/**
	*	AJAX ZONE	
	*/

	function ajaxGetNewPost()
	{
		var page_id = [ $("#selector-0").val() , $("#selector-1").val() , $("#selector-2").val() , $("#selector-3").val() ];
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetNewPost",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'page_id': page_id,
					'min_date': last_time_update
				},
				success:function(data)	
				{

					console.log("Get : ");
					console.log(data);
					addNewPost(data);
					setHightlightOrder();
				}
			});
	}

	function ajaxGetHighlightPost()
	{
		var page_id = [ $("#selector-0").val() , $("#selector-1").val() , $("#selector-2").val() , $("#selector-3").val() ];
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetHighlightPost",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'page_id': page_id
				},
				success:function(data)	
				{
					console.log("Highlight : ");
					console.log(data);
					editHighlightPost( data );
				}
			});
	}

	function ajaxCreatePageCard()
	{		
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetActivePage",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: false, 
				success:function(data)
				{
					createPageCard(data);
				}
			});
	}

	function ajaxFirstTimePost()
	{		
		var page_id = [ $("#selector-0").val() , $("#selector-1").val() , $("#selector-2").val() , $("#selector-3").val() ]
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxFirstTimePost",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'page_id': page_id
				},
				success:function(data)	
				{
					createFirstTimePost(data);
					removeOverPost();
				}
			});
	}

	function ajaxEditPageCard( page_id , target )
	{	
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxEditPageCard",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'page_id': page_id
				},
				success:function(data)
				{
					console.log("Edit : ");
					console.log(data);
					editOneNewPost( data[0] , target.substr(-1) );
					editBoxHead( data[1] , target.substr(-1) );
					ajaxGetHighlightPost();
					setHightlightOrder();
				}
			});
	}

	function ajaxUpdatePost()
	{		
		var post_array = $('.post-item').map(function(){
			return this.id.substr( 5 );
		}).get();
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxUpdatePost",
			type: 'post',
			dataType: 'json',
			async: true, 
			data: { 
				'post_array': post_array
			},
			success:function(data)
			{
				console.log("Update : ");
				console.log(data);
				updatePost( data );
			}
		});
	}


	/**
	* [setTempDefault description]
	*
	*	Set default for first value
	* 
	* @param {[type]} argument [description]
	*/
	
	function setTempDefault() 
	{
		$("#selector-0").val( '208428464667' ).trigger("change");
		$("#selector-1").val( '129558990394402' ).trigger("change");
		$("#selector-2").val( '146406732438' ).trigger("change");
		$("#selector-3").val( '401831669848423' ).trigger("change");

		$("#page-logo-0").attr( 'src' ,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6486778c78e03fd3a35a1c0f313c854f&oe=59757D5D' );
		$("#page-logo-1").attr( 'src' ,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/16473072_2314160078600938_4945021136999623596_n.jpg?oh=b31cb9f290883305123ab770b9ff3d6c&oe=59B6CE5C' );
		$("#page-logo-2").attr( 'src' ,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/10455805_10152859061547439_8950444073785058069_n.jpg?oh=9672bfc1899745829ce94016b20cfbff&oe=59B2FD1E' );
		$("#page-logo-3").attr( 'src' ,'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/15253552_1389781397720107_6557593025367614641_n.jpg?oh=462cd729acb43ac9e585835ce3977a8f&oe=59BC3E8B' );
	}

	/**
	* [initialize description]
	*
	*		Run first time
	* 
	* @return {[type]} [description]
	*/
	function initialize() 
	{
		ajaxCreatePageCard();
		setHightlightOrder();
		ajaxGetHighlightPost();
		setTempDefault();
		ajaxFirstTimePost();
	}

	function removeOverPost() 
	{
		for (var i = 0; i < 4; i++) 
		{
			var list_box = $("#list-box-"+i);
			list_box.each(function() 
			{
				$(this).find( 'li' ).each(function( index )
				{
					if ( index>10 ) 
					{
						console.log("Del : ");
						console.log( $( this ) );
						$(this).remove();
					}
					
				});
			});
		}
	}

	$('.feed-col').hide().fadeIn(700);
	$(document).ready(function() 
	{
		var box_height = $(document).height();
		$(".gray-box").height(box_height-60);

		initialize();

		$(".js-example-basic-single").on("select2:select", function (e) { ajaxEditPageCard( e.params.data.id , e.target.id ); });
		
		setInterval(function(){ 
			$('.post-item').removeClass('blink-item');
			ajaxUpdatePost();
			removeOverPost();
			ajaxGetHighlightPost();
		}, 60000);
		setInterval(function(){ 
			ajaxGetNewPost();
		}, 70000);
	});

</script>

</body>
</html>