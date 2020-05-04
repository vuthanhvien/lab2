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

 
if($user->exists()){
}else{
    wp_redirect('/login');
}


$options = Array();

$type = $_GET['type'];

if( $type != 'premium'){
    $type = 'standard';
}

$options['trial'] = $type == 'premium' ?  get_option('trial_standard_1_month') : get_option('trial_premium_1_month')  ;
$options['month'] = $type == 'premium' ?  get_option('standard_1_month') * 6 : get_option('premium_1_month') * 6 ;
$options['year'] = $type == 'premium' ?  get_option('standard_1_year') : get_option('premium_1_year')  ;
$vi = $GLOBALS['vi'];

if($vi){
    $options['trial']  = number_format($options['trial']* 23000) .' vnd';
    $options['month']  =  number_format($options['month']* 23000) .' vnd';
    $options['year']  =  number_format($options['year']* 23000) .' vnd';
}else{
   

    $options['trial']  = '$'.$options['trial'].'.00';
    $options['month']  = '$'.$options['month'].'.00';
    $options['year']  = '$'.$options['year'].'.00';
}

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
                <?php 
                if($GLOBALS['vi']){

                    if($type == 'premium') 
                    {
                        ?> <h3>Thanh toán gói premium &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0" href="/vi/payment/?type=standard">Qua gói stardard</a></h3> <?php
                    }else{
                        ?> <h3>Thanh toán gói standard &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0"  href="/vi/payment/?type=premium">Qua gói premium</a></h3> <?php
                    } 

                    if($type == 'premium'){
                        echo  '
                        <ul>
                        <li>Truy cập mọi số báo và tải được bản in preprint</li>
                        <li>Không quảng cáo, truy cập website vô hạn</li>
                        <li>Tải được email newsletter</li>
                        <li>Giảm 10% khi đăng ký tham dự Sự Kiện</li>
                        <li> Giảm 30% cho Báo Digital Strategy Lab</li>
                        <li>Podcast deep Digital/Tech dành riêng cho thành viên.</li>
                        <li> Nhận 1 tháng đầu miễn phí cho tài khoản thành viên mới</li>
                        </ul>';
                    }else{
                        echo  '
                        <ul>
                        <li><b> Nhận nội dung độc quyền, nội dung gốc từ Digital Strategy Lab hàng tháng và hàng quý (bao gồm series </b></li>
                        <li>Truy cập mọi số báo và tải được bản in preprint</li>
                        <li>Không quảng cáo, truy cập website vô hạn</li>
                        <li>Tải được email newsletter</li>
                        <li>Giảm 10% khi đăng ký tham dự Sự Kiện</li>
                        <li> Giảm 30% cho Báo Digital Strategy Lab</li>
                        <li>Podcast deep Digital/Tech dành riêng cho thành viên.</li>
                        <li> Nhận 1 tháng đầu miễn phí cho tài khoản thành viên mới</li>
                        </ul>
                        ';
                    }



                }else{

                    if($type == 'premium') 
                    {
                        ?> <h3>Payment for premium &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0" href="/payment/?type=standard">Go stardard</a></h3> <?php
                    }else{
                        ?> <h3>Payment for standard &nbsp;&nbsp;<a style="font-size: 16px;color: #0D87D0"  href="/payment/?type=premium">Go premium</a></h3> <?php
                    } 

                    if($type == 'premium'){
                        echo  '
                        <ul>
                        <li>Weekly article issues access and articles preprint download</li>
                        <li>Ad-free, unlimited website access</li>
                        <li>The Download email newsletter</li>
                        <li>10% discount to our events</li>
                        <li>30% Digital Strategy Lab Press discount</li>
                        <li>Deep Digital/Tech, our subscriber-only podcast </li>
                        <li>Get 1 month free trial for your first order </li>
                        </ul>';
                    }else{
                        echo  '
                        <ul>
                        <li><b> Monthly/Quarterly exclusive and original digital content (guide series, digital books, collections, magazine, cases etc)</b></li>
                        <li>Weekly article issues access and articles preprint download</li>
                        <li>Ad-free, unlimited website access</li>
                        <li>The Download email newsletter</li>
                        <li>10% discount to our events</li>
                        <li>30% Digital Strategy Lab Press discount</li>
                        <li>Deep Digital/Tech, our subscriber-only podcast </li>
                        <li>Get 1 month free trial for your first order </li>
                        </ul>';
                    }
                }
                ?>
            </div>
            <hr style="margin: 40px 0" >
            <div class="table-responsive">

                <!-- <label for="language">Plan available</label> -->
                <div class="plans">
                    <div class="plan-inner" >
                    <div class="plan <?php echo $isEx ? 'disabled' : '' ?>"  id="plan-trial">
                        <h2><?php echo $vi ? 'Xài thử 1 tháng' : 'Trial plan 1 month' ?></h2>
                        <h3><?php echo $options['trial']; ?></h3>
                        
                        <button id="select-trial"><?php echo $vi ? 'Chọn' : 'Select' ?></button>
                    </div>
                    </div>
                    <div class="plan-inner">
                    <div class="plan" id="plan-month">
                        <h2><?php echo $vi ? 'Mua cho 6 tháng' : 'For 6 months' ?></h2>
                        <h3><?php echo $options['month']; ?></h3>
                        <button id="select-month"><?php echo $vi ? 'Chọn' : 'Select' ?></button>
                    </div>
                    </div>
                    <div class="plan-inner">
                    <div class="plan" id="plan-year">
                        <h2><?php echo $vi ? 'Mua cho 1 năm' : 'For 1 year' ?></h2>
                        <h3><?php echo $options['year']; ?></h3>
                            <button id="select-year"><?php echo $vi ? 'Chọn' : 'Select' ?></button>
                    </div>
                    </div>
                </div>
                <br />
                <br />
                
                <div class="plan-action">
                    <p><?php echo $vi ? 'Gói' : 'Plan' ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b id="plan"></b></p>
                    <p><?php echo $vi ? 'Tổng cộng' : 'Total' ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b id="price">0.00$</b></p>
                    <br />
                    <br />
                    <button type="submit" style="text-transform: unset" id="submit" class="btn btn-default"><?php echo $vi ? 'Thanh toán qua VNPAY' : 'Make payment with VNPAY' ?></button>
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
            $('#price').html('<?php echo $options['trial'];  ?>')
            $('#plan').html('<?php echo $vi ? 'Xài thử 1 tháng' : 'Trial plan 1 month' ?>');
            selected = 'trial';

        })

        $('#select-month').click(function(){
            $('#plan-trial').removeClass('selected');
            $('#plan-month').addClass('selected');
            $('#plan-year').removeClass('selected');
            $('#price').html('<?php echo $options['month'];  ?>')
            $('#plan').html('<?php echo $vi ? 'Mua cho 6 tháng' : 'For 6 months' ?>');
            selected = 'month';
        })
        $('#select-year').click(function(){
            $('#plan-trial').removeClass('selected');
            $('#plan-month').removeClass('selected');
            $('#plan-year').addClass('selected');
            $('#price').html('<?php echo $options['year'];  ?>')
            $('#plan').html('<?php echo $vi ? 'Mua cho 1 năm' : 'For 1 year' ?>');
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
