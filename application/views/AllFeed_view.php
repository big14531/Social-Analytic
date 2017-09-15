<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu') ?>

<link href="https://fonts.googleapis.com/css?family=Kanit:200,300,400" rel="stylesheet">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=5">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/jquery.mCustomScrollbar.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<!-- Internal CSS Zone -->
<style>
	html,body{ margin:0; padding:0; height:100%; width:100%; font-family: 'Kanit', sans-serif;}
    .post-number{
        color:#FFF!;
    }
    .user-pic {
        display: block;
        width: 50px;
        float: left;
        border-radius: 5px;
        overflow: hidden;
        margin: 0px 10px;
    }
    .list-name {
        padding: 5px 0px;
        font-size: 18px;
        color: white;
        font-weight: 300;
    }
    .list-box li {
        padding: 10px 10px;
    }
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
    .list-right {
        width: 90%;
    }
	.box-header{
		background-color: #222d32;
        height : 100%;
        padding: 10px;
        width: 250px;
	}
    .box-header p{
        color:#a8a8a8;
    }
	.box-body{
		height: 100%;
		padding : 0px;
	}
	.feed-col{
		height: 100%!important;
	}
    .social-icon {
        display: inline-block;
        margin: 0px 15px;
        color: #83c8f7;
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
	.list-txt {
        font-size: 13px;
        font-weight: 300;
        width: 80%;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        line-height: 16px;
        max-height: 48px;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .list-social{
        font-size: 1.3em;
    }
    .social-icon span {
        font-size: 15px;
    }
    .social-icon i {
        margin-right: 5px
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
    .pagelist-control {
        padding: 20px 0;
        list-style: none;
    }
    .item-control{
        height: 60px;
        padding : 10px;
        background: #1a2226;
        margin-bottom: 10px;
        width: 200px;
    }
    .select2-container{
        margin-bottom:10px;
        width:100%!important;
    }
    .close-btn-control{
        background: #ec5b5b;
        color: white;
        position: absolute;
        left: 180px;
        font-size: 10px;
        width: 20px;
        height: 20px;
        border-radius: 20px;
        padding: 0px;
    }
    .close-btn-control:hover{
        color: white;
        width: 22px;
        height: 22px;
        border-radius: 22px;
    }
    .pagename-control{
        color:#FFF;
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


<!-- Content Zone -->
<div class="content-wrapper">

	<section class="content"> 
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1  feed-col" id="col-0">
				<div class="box gray-box">
                    <div class="box-header pull-right">
                        <p>ชื่อเพจ</p> <select class="js-example-basic-single" id="selector-0"></select>
                        <p>ประเภท</p> <select class="js-example-basic-single " id="selector-1"></select>
                        <button class="btn btn-info btn-block btn-sm" id="reset-btn">รีเซ็ต</button>
						<ul class="pagelist-control">
                        </ul>
                        
					</div>
					<div class="box-body mCustomScrollbar">
						<ul class="list-box" id="list-box-0">
							
							<li class="highlight-post" id="highlight-post-0"> 
								<div class="highlight-txt">ข่าวฮิตในช่วงครึ่งชั่งโมง</div>
								
								<a target="_blank" href="#" class="user-pic" id="highlight-link-0"><img id="highlight-pic-0" ></a> 
								<div class="list-right"> 
									<p id="highlight-name-0" class=" list-name"><span id="highlight-txt-0"></span><span id="highlight-date-0" class="white list-date"></span></p> 
									<div id="highlight-description-0" class="list-txt"></div> 

									<div class="list-social"> 
										<div class="white like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span id="highlight-like-0"></span></div> 
										<div class="white comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span id="highlight-comment-0"></span></div> 
										<div class="white shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span id="highlight-shared-0"></span></div> 
									</div> 
								</div> 
							</li> 

						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo(base_url());?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
	var current_page =[];
	var last_time_update = []; 
    var page_data =[];

    function addNewPageControl( page_id ) 
	{
		if( current_page.indexOf( page_id ) !== -1 )
		{
			return;
		}

        page_data.forEach(function(element) {
            if ( page_id==element.page_id) {
				current_page.push( element.page_id );
                var html =  '<li class="item-control" id="control_'+element.page_id+'">'+
                                '<button class="btn btn-alert close-btn-control" onclick="removePageControl('+element.page_id+')"><i class="fa fa-close"></i></button>'+
                                '<img class="page-logo pull-left" id="page-logo" src='+element.picture+'>'+
                                '<p class="pagename-control">'+element.name+'</p>'+
                            '</li>';
                $('.pagelist-control').append( $(html).hide().fadeIn(500) );
            }
        }, this);
        
	}

	function removePageControl( object ) 
	{
		var index = current_page.indexOf(object);
		current_page.splice(index, 1);
		$('.pagelist-control').find( "#control_"+object ).remove();
	}

	function clearControl() 
	{
		current_page =[];
		$('.pagelist-control').empty().fadeIn(500);	
	}

	function setHightlightOrder()
	{
		$("#list-box-"+0+" li:eq(0)").before($("#highlight-post-"+0));
		$("#list-box-"+1+" li:eq(0)").before($("#highlight-post-"+1));
		$("#list-box-"+2+" li:eq(0)").before($("#highlight-post-"+2));
		$("#list-box-"+3+" li:eq(0)").before($("#highlight-post-"+3));
	}

	function addPosttoFeed( data ) 
	{
		$("#list-box-0").empty();
		data.forEach(function(element) {
			appendPost( element );
		}, this);
	}

	function appendPost( post ) 
	{
		var list_box = $("#list-box-0");
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
		+'<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span  class="post-number" id="engage_number">'+post.engage+'</span></div>'
		+'<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span  class="post-number" id="comment_number">'+post.comments+'</span></div>'
		+'<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span  class="post-number" id="share_number">'+post.shares+'</span></div>'
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
		var page_list=[];
        var cat_list=[];

		for (var i = 0; i < data.length; i++) 
		{
			var name = data[i].name;
			var page_id = data[i].page_id;
			var category_list = data[i].category_list;
			page_list.push( { id: page_id, text: name} );
		}
		$("#selector-0").select2({
			data: page_list
		});

        var page_obj = data[0];
        var object = $("#col-0");
        var selector = $("#selector-0");
        selector.val( page_obj.page_id ).trigger("change");
        var page_logo_obj = $("#page-logo-0");
        page_logo_obj.attr( 'src' ,page_obj.picture );
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

	function createSelector( data ) 
	{
		var cat_list=[];
		for (var i = 0; i < data.length; i++) 
		{
			var id = data[i].id;
			var name = data[i].name;
			cat_list.push( { id: id, text: name } );
		}
		$("#selector-1").select2({
			width: '100%',
			minimumResultsForSearch: Infinity,
			data:cat_list
		});
	}
	/**
	*	AJAX ZONE	
	*/

	function ajaxGetActivePage()
	{		
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetActivePage",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: false, 
				success:function(data)
				{
                    console.log( data ); 
                    page_data = data;   
					createPageCard(data);
				}
			});
	}

	function ajaxGetNewPostList( category_name )
	{
		console.log( category_name );
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetNewPostListbyCat",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'category_name': category_name,
					'min_date': last_time_update
				},
				success:function(data)	
				{
					console.log(data);
					clearControl();
					data[0].forEach(function(element) {
						addNewPageControl( element.page_id );
					}, this);
					addPosttoFeed( data[1] );
					
				}
			});
	}

	function ajaxGetNewPost( current_page )
	{
		console.log( current_page );
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetNewPostListbyPageID",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'page_id_list': current_page,
					'min_date': last_time_update
				},
				success:function(data)	
				{
					console.log(data);
					addPosttoFeed( data );
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
					// console.log("Highlight : ");
					// console.log(data);
					editHighlightPost( data );
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
					// console.log("Edit : ");
					// console.log(data);
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
				// console.log("Update : ");
				// console.log(data);
				updatePost( data );
			}
		});
	}

	function ajaxGetPageCategory() 
	{
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxGetPageCategory",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			dataType: 'json',
			async: false, 
			success:function(data)	
			{
				console.log(data);
				createSelector( data )
				
			}
		});
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
		ajaxGetActivePage();
		setHightlightOrder();
		ajaxGetHighlightPost();
		ajaxGetPageCategory();
		ajaxFirstTimePost();
	}

	function removeOverPost() 
	{

		var list_box = $("#list-box-"+i);
		list_box.each(function() 
		{
			$(this).find( 'li' ).each(function( index )
			{
				if ( index>30 ) 
				{
					// console.log("Del : ");
					// console.log( $( this ) );
					$(this).remove();
				}
				
			});
		});
		
	}



	$(document).ready(function() 
	{
		var box_height = $(document).height();
		$(".gray-box").height(box_height-60);

		initialize();

		$("#selector-0").on("select2:select", function (e) { 
            ajaxEditPageCard( e.params.data.id , e.target.id ); 
            addNewPageControl( e.params.data.id );
			ajaxGetNewPost( current_page )
        });
		
		$("#selector-1").on("select2:select", function (e) { 
			ajaxGetNewPostList( e.params.data.id )
        });
		
		$('#reset-btn').on( 'click' , function(){
			clearControl();
		});

		$( ".close-btn-control" ).click(function(){
			console.log('ddddf');
		});

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