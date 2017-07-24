<!-- FLOT CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.min.js"></script>  

<?php
foreach ($result as $key => $value) {

    foreach ($value as $key => $inner_value) {
    
        print_r( $inner_value );
        // echo $inner_value.likes;
        echo "<br><br>";
    }
    echo "++++++++++++++++++++++++++<br>";
}

