<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
    .graph_tab.active a{
        background-color:#3c8dbc!important;
    }
    .graph_tab.active{
        border-top:0px!important;
    }
    .full-width{
        width:100%;
    }
    .graph-box{
        padding: 20px;
    }
    .table-img{
        width:100px;
    }
    .tooltip-inner{
        max-width: 400px!important;
        z-index: 200;
    }
    #daterange-btn{
        height:37px;
        text-align: center;
        font-size: 14px;
    }
</style>


<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css">

<!-- Content Here -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Posts Graph
    </h1>
</section>

<section class="content">   

    <div id='alert' class="alert alert-dismissible hidden">
        <h3>Success!!</h3> 
        <p>This is a green alert.</p>
    </div>

    <div class="box gray-box">
        <div class="box-header">
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group full-width">
                        <button type="button" class="selectpicker btn btn-lg btn-default full-width" id="daterange-btn">
                            <span>
                                <i class="fa fa-calendar"></i> Date range
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <select class="selectpicker form-control" id="page-selector" style="width: 100%;">
                            <option selected="selected">Select Page</option>
                            <?php 
                            foreach ($page_list as $value) 
                            {
                              echo "<option id='".$value->page_id."'>".$value->name."</option>";
                          }
                          ?>
                      </select>
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
    </div>
</div>

<div class="box gray-box">
    <div class="row">
        <div class="graph-box">
            <div id="placeholder" style="width:100%;height:500px">
            </div>
        </div>
    </div>
</div>
</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<!-- FLOT CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT TIME CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.time.js"></script>
<!-- FLOT SYMBOL -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.symbol.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>

function convertTime( data )
    { 
        var temp_date = data.substr(0,10);
        var date = temp_date.split("-");
        var time = data.substr(11);
        var result = date[2]+"-"+date[1]+"-"+date[0]+" "+time;
        return result;
    }

    function generateData ( data ) 
    {
        var result =[];
        var label =[];
        for (var i = 0; i < data.length; i++)
        {

            var raw_time = data[i].created_time;
            var time = new Date(raw_time);
            var unixtime = time.getTime();
            var like = data[i].likes;


            var text = [
            data[i].name,
            data[i].page_name,
            data[i].page_id,
            data[i].post_id,
            data[i].picture
            ];

            result.push( [unixtime ,like] );
            label.push( {label: text } );
        }

        var fan_dataset = 
        {
            data: result,
            color: "#00c0ef",
            label: "Post",   
            extraData: label
        };

        return fan_dataset;

    }

    function plotGraph( data ) 
    { 
        var fan_dataset = generateData( data );
        var options = 
        {
         legend:{
            show:false
        },       
        series: {
            points: {
                show: true,
                radius: 5,
                fill: true,
                fillColor: false
            }
        },
        grid: {
            hoverable: true,
            clickable: true

        },
        xaxis:
        {
            show: true,
            mode: "time",
            timeformat: "%H:%M:%S <br> %d-%b ",
            timezone: "browser",
            autoscaleMargin: 0.05

        },
        yaxis: 
        {
            show: true
        }
    };

    var placeholder = $("#placeholder");
    var plot = $.plot("#placeholder", [fan_dataset] , options );


    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: "absolute",
        display: "none",
        opacity: 0.8
    }).appendTo("body");

    placeholder.bind("plotclick", function (event, pos, item) {
     if (item) {
        var index = item.dataIndex;
        var label = item.series.extraData[index].label;
        var page_id = label[2];
        var post_id = label[3];
        var analytic_link = "<?php echo base_url() ?>"+"postAnalytic/"+page_id+"/"+post_id;
        window.open( analytic_link, '_blank');
    }
});
    placeholder.bind("plothover", function (event, pos, item) {

        if (item) {

            var index = item.dataIndex;
            var label = item.series.extraData[index].label;
            var name = label[0]; 
            var page_name = label[1];
            var picture = label[4];

            var date = new Date(item.datapoint[0]);
                    // Hours part from the timestamp    
                    var hours = date.getHours();
                    // Minutes part from the timestamp
                    var minutes = "0" + date.getMinutes();
                    // Seconds part from the timestamp
                    var seconds = "0" + date.getSeconds();
                    // Seconds part from the timestamp
                    var year = "0" + date.getFullYear();
                    // Seconds part from the timestamp
                    var month = "0" + date.getMonth();
                    var month = parseInt( month )+1;
                    // Seconds part from the timestamp
                    var day = "0" + date.getDate();
                    // Will display date in DD/MM/YYYY format
                    var formattedDate = day.substr(1) + '-' + month + '-' + year.substr(1);
                    // Will display time in 10:30:23 format
                    var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

                    var date = "Date : "+formattedDate;
                    var time = "Time : "+formattedTime;
                    y = item.datapoint[1].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");

                    $("#line-chart-tooltip").html( 

                        '<div class="row"><div class="col-xs-6"><image class="table-img" src='+picture+' /></div><div class="col-xs-6">'+name+'<br>'+date+'<br>'+time+'<br> '+'likes : '+ y+'</div></div>'
                        )
                    .css({top: item.pageY - 150, left: item.pageX - 250})
                    .fadeIn(200);
                } else {
                    $("#line-chart-tooltip").hide();
                }
            });

    $(".graph-box").resizable({
        maxWidth: 900,
        maxHeight: 700,
        minWidth: 450,
        minHeight: 250
    });
}

function ajaxCall( page_id , min_date , max_date )
{
    $('#search-btn').find('span').text('Searching.....');
    $('#search-btn').addClass('disabled');
    $('#search-btn').prop('disabled',true);
    $.ajax({
            url:  "<?php echo(base_url());?>ajaxPostList",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET   
            data: { 
                'page_id': page_id, 
                'min_date': min_date,
                'max_date': max_date 
            },
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                var page_name = $('#page-selector').find(':selected').text();
                if (data.length == 0) 
                {
                    $('#alert').removeClass( 'alert-success');
                    $('#alert').addClass( 'alert-warning');
                    $('#alert').find('h3').text( "ไม่มีข้อมูลในช่วงเวลานี้ - "+page_name );
                    $('#alert').find('p').text(  "Post from "+min_date+" - "+max_date+" " );
                    $('#alert').removeClass( 'hidden');
                }
                else
                {
                    $('#alert').removeClass( 'alert-warning');
                    $('#alert').addClass( 'alert-success');
                    $('#alert').find('h3').text( "ค้นหาสำเร็จ!!" );
                    $('#alert').find('p').text('');
                    $('#alert').removeClass( 'hidden');
                }
                $('#search-btn').prop('disabled',false);
                $('#search-btn').removeClass('disabled');
                $('#search-btn').find('span').html('<i class="fa fa-calendar"></i> Search');
                plotGraph(data);
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

$

$(document).ready(function() 
{
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
    
    $('#search-btn').click(function()
    {
        var page_id = $('#page-selector').find(':selected').attr('id');
        var date_range = $('#daterange-btn').val();
        var date = date_range.split(' to ');
        if ( Boolean(page_id) && Boolean(date_range) ) 
        {
            ajaxCall(  page_id , date[0] , date[1] );
        }
        else
        {
            $('#alert').removeClass( 'alert-info');
            $('#alert').removeClass( 'hidden');
            $('#alert').removeClass( 'alert-success');
            $('#alert').removeClass( 'alert-warning');
            $('#alert').addClass( 'alert-warning');
            $('#alert').find('h3').text( "Please set date and page name" );
            $('#alert').find('p').text( '' );
        }
        $("#alert").fadeTo(2000, 500).slideUp(500, function()
        {
            $("#alert").slideUp(500);
        });
    });
});
</script>


