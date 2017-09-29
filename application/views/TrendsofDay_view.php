<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu') ?>


<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=5">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/jquery.mCustomScrollbar.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<!-- Internal CSS Zone -->
<style>
    .list-box>li{
        padding: 10px 0px;
    }
	.mCSB_inside>.mCSB_container{
		margin-right:10px!important;
	}
	.box-body{
		height: 100%;
		padding : 0px;
	}
    .feed-col{
        margin-top: 10px;
        padding: 0px;
        background: #1a2226;
    }
    .main-row{
        margin: 0px;
    }
    .control-row{
        padding: 10px;
        background: #1a2226;
        border-radius: 5px;
    }
    .btn{ 
        border-radius: 40px;
    }
    .select2-container .select2-selection--single{
        height:auto;
    }
    #category-selector{
        width:100%;
    }
    .item-image{
        height:100px;
        padding:0px;
        text-align: center;
    }
    .item-image>img{
        border-radius: 5px;
    }
    .rank-number{
        font-size: 2em;
        color: #d4d4d4;
        padding: 50px 30px;
    }
    .page-logo-statusbar{
        float:left;
        width:30px;
        margin: 0px 5px;
    }
    .count-text{
        display: inline;
        margin-left: 10px;
        font-size: 14px;
    }
    .keyword-text{
        font-size: 2em;
    }
    .status-bar{
        display: inline-flex;
    }
    .item-detail>div{
        padding: 5px 0px;
        color: #d4d4d4;
        font-weight:300;
    }
    .post-head>a{
        color: #3c8dbc;
    }
    .post-head>a:hover{
        color: #d4d4d4;
        text-decoration: underline;
    }
    .post-example{
        font-size: 15px;
    }
    .post-example>div{
        padding: 2px 0px;
    }
    .widget-footer-container{
        display:none!important;
    }
    .post-description{
        width: 80%;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 16px;
        max-height: 16px;
    }
   

</style>


<!-- Content Zone -->
<div class="content-wrapper">

    <section class="content-header">
		<h1>
			Trends ต่อวัน
		</h1>
	</section>

	<section class="content"> 
            <div class="control-row col-md-12">
                <div class="date-picker col-md-4">
                    <button type="button" class="selectpicker btn btn-md btn-block btn-default" id="daterange-btn">
                        <span><i class="fa fa-calendar"></i> เลือกวันที่</span><i class="fa fa-caret-down"></i>
                    </button>
                </div>
                <!-- <div class="category-selector col-md-4">
                    <select id="category-selector"></select>
                </div> -->
                <div class="category-selector col-md-4">
                    <button class="btn btn-info btn-block" id="submit-btn">
                        <span><i class="fa fa-calendar"></i> ค้นหา</span>
                    </button>
                </div>
                
            </div>

            <div class="feed-col col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="box-body mCustomScrollbar">
                    <ul class="list-box" id="list-box-0">
                    </ul>
                </div>
            </div>
	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo(base_url());?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>

    function createCard( data ) 
    {

        var keyword = data[0];
        var post_array = data[1];
        var number = 1;
        for (var index = 0; index < keyword.length; index++) 
        {
            var keyword_item = keyword[index];
            var post_item = post_array[index][0];
            var page_item = post_array[index][1];
            if( post_item.length )
            {
                var page_icon_html = '';
                page_item.forEach(function(element) 
                {
                    page_icon_html+= '<img class="page-logo-statusbar" src="'+element.picture+'" alt="">'
                }, this);

                var html =  '<li>'+
                            '<div class="rank-number col-md-1">'+number+'</div>'+
                            '<div class="item-image col-md-2">'+
                                '<img class="item-image" src="'+post_item[0].picture+'" alt="">'+
                            '</div>'+
                            '<div class="item-detail col-md-9">'+
                                '<div class="keyword-text">'+keyword_item.keyword+
                                    '<div class="count-text">'+( keyword_item.count)+' posts</div> '+
                                '</div>'+
                                '<div class="status-bar">'+
                                    
                                    '<div class="page-logo" >'+
                                        page_icon_html+
                                    '</div>'+
                                '</div>'+
                                '<div class="post-example">'+
                                    '<div class="post-head">'+
                                        '<a href="'+post_item[0].permalink_url+'" target="_blank">'+post_item[0].name+'</a>'+
                                    '</div>'+
                                    '<div class="post-description">'+post_item[0].description+'</div>'+
                                    '</div>'+
                            '</div>'+
                        '</li>';
                number +=1;
                appendItem( html );
                
            }
            
            
        }
    }    

    function appendItem( html ) 
    {
        $('#list-box-0').append( html );    
    }

    function createDatepicker() 
    {
        $('#daterange-btn').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		});
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
		$("#category-selector").select2({
			minimumResultsForSearch: Infinity,
			data:cat_list
		});
    }

    function createCategorySelector() 
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

    function getTrendsData( min_date , max_date ) 
    {
        $.ajax({
			url:  "<?php echo(base_url());?>ajaxGetTrendsData",
			type: 'post', 
			dataType: 'json',
			async: false, 
            data: {  
				'min_date': min_date,
				'max_date': max_date
			}, 
			success:function(data)	
			{
				console.log(data);
                $('#list-box-0').empty();		
                createCard( data );
			}
		});    
    }

    function initialize() 
    {
        var box_height = $(window).height();
		$(".feed-col").height(box_height-180);
        createDatepicker();
        // createCategorySelector();
        getTrendsData();
    }

    $(document).ready(function() 
	{
		initialize();
        $( '#submit-btn' ).on( 'click' , function(){
            var date =  $('#daterange-btn').val().split( ' to ' );
            var type = $('#category-selector').val();

            if (date) {
                getTrendsData( date[0] , date[1] );
            }
            else{
                alert( 'กรุณาเลือกวันที่' )
            }
            
        });
	});
</script>

</body>
</html>