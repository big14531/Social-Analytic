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
    vertical
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
        padding: 5px 0px;
        display:block;
        float:left;
        margin-right: 10px;
    }
    .keyword-text{
        font-size: 2.5em;
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
                <div class="date-picker col-md-6">
                    <button type="button" class="selectpicker btn btn-md btn-block btn-default" id="daterange-btn">
                        <span><i class="fa fa-calendar"></i> เลือกวันที่</span><i class="fa fa-caret-down"></i>
                    </button>
                </div>
                <div class="category-selector col-md-6">
                    <select id="category-selector"></select>
                </div>
            </div>
            <div class="feed-col col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="box-body mCustomScrollbar">
                    <ul class="list-box" id="list-box-0">
                        <li>
                            <div class="rank-number col-md-1"> 1 </div>
                            <div class="item-image col-md-3">
                                <img src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                            </div>
                            <div class="item-detail col-md-8">
                                <div class="keyword-text">บิ๊กตู่</div>
                                <div class="status-bar">
                                    <div class="count-text">10000+ words</div> 
                                    <div class="page-logo" >
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                    </div>
                                    
                                </div>
                                <div class="post-example">
                                    <div class="post-head">
                                        <a href="" target="_blank">11 ปีแห่งความหลัง"บิ๊กบัง"เสียของ แปรเป็นพิมพ์เขียว"บิ๊กตู่"</a>
                                    </div>
                                    <div class="post-description">11 ปีแห่งความหลัง"บิ๊กบัง"เสียของ แปรเป็นพิมพ์เขียว"บิ๊กตู่"</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="rank-number col-md-1"> 1 </div>
                            <div class="item-image col-md-3">
                                <img src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                            </div>
                            <div class="item-detail col-md-8">
                                <div class="keyword-text">บิ๊กตู่</div>
                                <div class="status-bar">
                                    <div class="count-text">10000+ words</div> 
                                    <div class="page-logo" >
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                        <img class="page-logo-statusbar" src="https://external.xx.fbcdn.net/safe_image.php?d=AQCEfGBl08rZFN5B&w=130&h=130&url=http%3A%2F%2Fmedia.komchadluek.net%2Fimg%2Fsize1%2F2017%2F09%2F20%2Ffhaakf785hbdc576b5i5c.JPG&cfs=1&sx=0&sy=0&sw=438&sh=438&_nc_hash=AQCPLN0PkyOwZCGO" alt="">
                                    </div>
                                    
                                </div>
                                <div class="post-example">
                                    <div class="post-head">
                                        <a href="" target="_blank">11 ปีแห่งความหลัง"บิ๊กบัง"เสียของ แปรเป็นพิมพ์เขียว"บิ๊กตู่"</a>
                                    </div>
                                    <div class="post-description">11 ปีแห่งความหลัง"บิ๊กบัง"เสียของ แปรเป็นพิมพ์เขียว"บิ๊กตู่"</div>
                                </div>
                            </div>
                        </li>
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

    function initialize() 
    {
        var box_height = $(window).height();
		$(".feed-col").height(box_height-180);

        createDatepicker();
        createCategorySelector();
    }

    $(document).ready(function() 
	{
		initialize();
	});
</script>

</body>
</html>