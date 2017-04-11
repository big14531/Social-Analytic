<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
    .table-icon{
        width:20px;
        margin: 0px;
    }
    .table-img{
        width:50px;
    }
    .full-width{
        width:100%;
    }
</style>

<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css">


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tracking page data
        </h1>

    </section>

   

    <!-- Main content -->
    <section class="content">

        <div id='callout' class="callout hidden">
            <h4>Success!!</h4>
            <p>This is a green callout.</p>
        </div>  

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 id="page_count">0</h3>
                        <p>Tracking page</p>
                    </div>
                    <div class="icon">
                        <i class="ion-social-facebook"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_post">0</h3>
                        <p>Total Post</p>
                    </div>
                    <div class="icon">
                        <i class="ion-android-textsms"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="post_rate">0</h3>
                        <p>posts / hour rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-pulse-strong"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group full-width">
                    <button type="button" class="btn btn-lg btn-default pull-left full-width" id="daterange-btn">
                    <span>
                      <i class="fa fa-calendar"></i> Date range
                    </span>
                    <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-info full-width" id="search-btn">
                    <span>
                    <i class="fa fa-calendar"></i> Search
                    </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="display table table-bordered">
                            
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>


<script>
    function createDatepicker(){
         $('#daterange-btn').daterangepicker(
         {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
        }
        );
    }

    function ajaxCall( min_date=0 , max_date=0 )
    {
        $('#search-btn').find('span').text('Searching.....');
        $('#search-btn').addClass('disabled');
        $('#search-btn').prop('disabled',true);
        $.ajax({
            url:  "<?php echo base_url()?>/ajaxPageTable",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            data: {  
                    'min_date': min_date,
                    'max_date': max_date 
                }, 
            dataType: 'json',
            success:function(data)
            {
                $('#search-btn').prop('disabled',false);
                $('#search-btn').removeClass('disabled');
                $('#search-btn').find('span').html('<i class="fa fa-calendar"></i> Search');

                $('#callout').removeClass( 'hidden');
                $('#callout').removeClass( 'callout-success');
                $('#callout').removeClass( 'callout-warning');
                $('#callout').addClass( 'callout-success');
                $('#callout').find('h4').text( "สำเร็จ!!" );
                $('#callout').find('p').text( '' );

                var result = editData(data )
                renderTable( result );
            },
            error:function(xhr, textStatus, errorThrown) 
            {
                $('#search-btn').prop('disabled',false);
                $('#callout').removeClass( 'hidden');
                $('#callout').removeClass( 'callout-success');
                $('#callout').addClass( 'callout-danger');
                $('#callout').find('h4').text( "Error!!" );
                $('#callout').find('p').text( textStatus+" "+errorThrown+" "+xhr );
            }   
        }); 
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
    }

    function editData(data)
    {
        console.log( data );

        var date = new Date();
        var date = date.getHours();
        var page_count = 0;
        var total_post = 0;
        var post_rate = 0;

        var dataset=[];
        for ( var key in data )
        {
           var value = data[key];
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

          var rate =  Math.ceil( value.count / date );             

           dataset[key] = 
           [
           value.picture,
           value.name,
           parseInt ( value.fan_count ).toLocaleString('en-US'),
           parseInt ( value.count ).toLocaleString('en-US'),
           rate,
           engagement.toLocaleString('en-US'),
           parseInt ( value.shares ).toLocaleString('en-US'),
           parseInt ( value.comments ).toLocaleString('en-US'),
           reaction.toLocaleString('en-US'),
           parseInt ( value.likes ).toLocaleString('en-US'),
           parseInt ( value.love ).toLocaleString('en-US'),
           parseInt ( value.wow ).toLocaleString('en-US'),
           parseInt ( value.haha ).toLocaleString('en-US'),
           parseInt ( value.sad ).toLocaleString('en-US'),
           parseInt ( value.angry ).toLocaleString('en-US'),
           value.website,
           value.link 
           ];

            page_count += 1;
            total_post += parseInt ( value.count );
            post_rate += rate;
        }

        $('#page_count').text( page_count.toLocaleString('en-US') );
        $('#total_post').text( total_post.toLocaleString('en-US') );
        $('#post_rate').text( post_rate.toLocaleString('en-US') );

        return dataset;
     }

    function createTable( data ) {

        $('#example1').DataTable( {
            columns: [

            { title: "Image" ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                     $(nTd).html("<image class='table-img' src='"+sData+"' />");
                }},
            { title: "Name" },
            { title: "Fanpage" },
            { title: "Post" },
            { title: "Post rate" },
            { title: "Engage" },
            { title: "Share" },
            { title: "Comments" },
            { title: "Reaction" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/like.png'>" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/love.png'>" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/wow.png'>" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/smile.png'>" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/sad.png'>" },
            { title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/angry.png'>" },
            { title: "<i class='fa fa-globe' aria-hidden='true'>" ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                     $(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
                }
            },
            { title: "<i class='fa fa-facebook-official' aria-hidden='true'>" ,
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                     $(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
                }
            }
           
            ],
            "iDisplayLength": 20
        } );
    }


    

    $('#search-btn').click(function()
    {

        var date_range = $('#daterange-btn').val();
        var date = date_range.split(' to ');
        if ( Boolean(date_range) ) 
        {
          ajaxCall( date[0] , date[1] );
        }
        else
        {
            $('#callout').removeClass( 'hidden');
            $('#callout').removeClass( 'callout-success');
            $('#callout').removeClass( 'callout-warning');
            $('#callout').addClass( 'callout-warning');
            $('#callout').find('h4').text( "ข้อมูลไม่ครบ!!" );
            $('#callout').find('p').text( 'กรุณาเลือกวันที่ต้องการค้นหา' );
        }
        
    });

    createTable();
    createDatepicker();


</script>

