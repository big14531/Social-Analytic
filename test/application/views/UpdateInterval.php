
<div id="time"></div>

<div id="a"></div>
<div id="b"></div>
<div id="c"></div>
<!-- jQuery 2.2.3 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
    sweep();
    post();
    page();

	setInterval(function(){
		
         $('#time').text(Date());
            
	},1000);


    function sweep()
    {
        console.log("Getting Post "+Date());
        $.ajax({
            url:  "<?php echo(base_url());?>sweepFacebookPost/10/0",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET   
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                $('#a').text(data);
                console.log("Sweep :"+Date());
            }
        });
    }

    function post() 
    {
        console.log("Updating Post "+Date());
        $.ajax({
            url:  "<?php echo(base_url());?>updateFacebookPost/60",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET   
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                $('#b').text(data);
                console.log("Update Post :"+Date());
            }
        });
    } 


    function page() 
    {
        console.log("Updating page "+Date());
         $.ajax({
            url:  "<?php echo(base_url());?>updateTrackingPage",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET   
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                $('#c').text(data);
                console.log("Update Page :"+Date());
            }
        });
        
    } 


	setInterval(function(){
		sweep();
	},600000);


	setInterval(function(){
        post();
	},60000);

	setInterval(function(){
        page();
	},1800000);
</script>

<!-- 