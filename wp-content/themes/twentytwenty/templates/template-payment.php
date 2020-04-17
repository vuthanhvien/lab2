<?php
/**
 * Template Name: Payment Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */


$user = wp_get_current_user();

$options = Array();

$type = $_GET['type'];

if( $type != 'premium'){
    $type = 'standard';
}

$options['trial'] = $type == 'premium' ?  get_option('trial_standard_1_month') : get_option('trial_premium_1_month')  ;
$options['month'] = $type == 'premium' ?  get_option('standard_1_month') * 6 : get_option('premium_1_month') * 6 ;
$options['year'] = $type == 'premium' ?  get_option('standard_1_year') : get_option('premium_1_year')  ;


get_header();

$fields =  get_fields('user_'.$user->ID); 
if($fields['date_end_standard'] && $type =='standard'){
    $isEx = true;
}

if($fields['date_end_premium'] && $type =='premium'){
    $isEx = true;
}

?>

<main id="site-content" role="main">
<div class="section-inner" >
<div class="profile">
<div class="container">
            <div class="header clearfix">
                <?php if($type == 'premium') {
                    ?>
                        <h3>Payment premium &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0" href="/payment/?type=standard">Go stardard</a></h3>
                    <?php
                }else{
                    ?>
                        <h3>Payment standard &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0"  href="/payment/?type=premium">Go premium</a></h3
                <?php
                } ?>
                <p style="width: 70%">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <hr style="margin: 40px 0" >
            <div class="table-responsive">

                <!-- <label for="language">Plan available</label> -->
                <div class="plans">
                    <div class="plan-inner" >
                    <div class="plan <?php echo $isEx ? 'disabled' : '' ?>"  id="plan-trial">
                        <h2>Trial plan 1 month</h2>
                        <h3>$<?php echo $options['trial']; ?>.00</h3>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur </p>
                        <p>Lorem ipsum dolor sit amet</p>
                        <button id="select-trial">Select</button>
                    </div>
                    </div>
                    <div class="plan-inner">
                    <div class="plan" id="plan-month">
                        <h2>For 6 month</h2>
                        <h3>$<?php echo $options['month']; ?>.00</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <p>Lorem ipsum dolor sit amet</p>
                        <button id="select-month">Select</button>
                    </div>
                    </div>
                    <div class="plan-inner">
                    <div class="plan" id="plan-year">
                        <h2>For 1 year</h2>
                        <h3>$<?php echo $options['year']; ?>.00</h3>
                        <p>Lorem ipsum dolor sit amet</p>
                        <p>Lorem ipsum dolor sit amet</p>
                        <button id="select-year">Select</button>
                    </div>
                    </div>
                </div>
                <br />
                <br />
                
                <div class="plan-action">
                    <p>Plan: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b id="plan"></b></p>
                    <p>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b id="price">0.00$</b></p>
                    <br />
                    <br />
                    <button type="submit" id="submit" class="btn btn-default">Make payment with VNPAY</button>
                    </div>
                    <br />
                    <br />
            </div>
        </div>  

        <script type="text/javascript">

        var selected = '';
            $( document ).ready(function() {
                $('#select-month').click();
            });

        $('#select-trial').click(function(){
            $('#plan-trial').addClass('selected');
            $('#plan-month').removeClass('selected');
            $('#plan-year').removeClass('selected');
            $('#price').html('$<?php echo $options['trial'];  ?>.00')
            $('#plan').html('Trial for 1 month');
            selected = 'trial';

        })

        $('#select-month').click(function(){
            $('#plan-trial').removeClass('selected');
            $('#plan-month').addClass('selected');
            $('#plan-year').removeClass('selected');
            $('#price').html('$<?php echo $options['month'];  ?>.00')
            $('#plan').html('6 months');
            selected = 'month';
        })
        $('#select-year').click(function(){
            $('#plan-trial').removeClass('selected');
            $('#plan-month').removeClass('selected');
            $('#plan-year').addClass('selected');
            $('#price').html('$<?php echo $options['year'];  ?>.00')
            $('#plan').html('1 year');
            selected = 'year';
        })


        $("#submit").click(function () {
            $.ajax({
                type: "POST",
                url: '/vnpay.php',
                data: {
                    order_type: selected,
                    type: '<?php echo $type ?>'
                },
                dataType: 'JSON',
                success: function (x) {
                    if (x.type == 'success') {
                        location.href = x.url;
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
            });
        </script>

<p class="auth-redirect">

</p>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
