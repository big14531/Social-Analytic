<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard<small> facebook post analytic</small>
        </h1>
    </section>

    <section class="content">
        <div class="box">

        <?php
            $error = isset( $_GET['authofail'] )? $_GET['authofail']:0;
            if ( $error ) {
                echo '<div id="callout" class="callout callout-danger">';
                echo '<h4>Authorization Alert!!</h4>';
                echo '<p>This path is restriction site</p>';
                echo '</div>';
            }
        ?>

        </div>
    </section>

</div>

<?php $this->load->view( 'default/bottom' ) ?>

