<?php
/**
 * Template Name: Profile Template
 * Template Post Type: post, page
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


if($_POST['type']){
    if($_POST['type'] == 'profile'){

        $profile = $_POST;
        unset($_POST);

        $first_name = $profile['first_name'];
        $last_name = $profile['last_name'];
        $phone = $profile['phone'];

        wp_update_user(array('ID' => $user->ID, 'first_name' => esc_attr($first_name )));
        wp_update_user(array('ID' => $user->ID, 'last_name' => esc_attr($last_name )));
        update_field('phone', $phone , 'user_'.$user->ID     );

    }
    if($_POST['type'] == 'password'){
        $passdata = $_POST;
        unset($_POST['type']);

        $x = wp_check_password( $passdata['old_password'], $user->user_pass, $user->data->ID );
        if($x)
        {
            if( !empty($passdata['new_password']) && !empty($passdata['confirm_password']))
            {
                if($passdata['new_password'] == $passdata['confirm_password'])
                {
                    $udata['ID'] = $user->data->ID;
                    $udata['user_pass'] = $passdata['new_password'];
                    $uid = wp_update_user( $udata );
                    if($uid) 
                    {
                        $passupdatemsg = "The password has been updated successfully";
                        $passupdatetype = 'successed';
                        unset($passdata);
                    } else {
                        $passupdatemsg = "Sorry! Failed to update your account details.";
                        $passupdatetype = 'errored';
                    }
                }
                else
                {
                    $passupdatemsg = "Confirm password doesn't match with new password";
                    $passupdatetype = 'errored';
                }
            }
            else
            {
                $passupdatemsg = "Please enter new password and confirm password";
                $passupdatetype = 'errored';
            }
        } 
        else 
        {
            $passupdatemsg = "Old Password doesn't match the existing password";
            $passupdatetype = 'errored';
        }
    }
}

$tab = $_GET['tab'] ?  $_GET['tab'] : 'profile';

$vi = $GLOBALS['vi'];

$prefix = $vi ? '/vi' : '';

get_header();
?>

<main id="site-content" role="main">
<div class="section-inner" >
<div class="profile">
    <h4><?php echo $vi ? 'Quản lý tài khoản' : 'Manage your account' ?> </h4>
    <br />

    <a class="profile-tab <?php echo $tab =='profile' ? 'active' : '' ?>" href="<?php echo $prefix ?>/profile/?tab=profile" ><?php echo $vi ? 'Thông tin cá nhân' : 'Profile' ?> </a>
    <!-- <a class="profile-tab <?php echo $tab =='plan' ? 'active' : '' ?> " href="<?php echo $prefix ?>/profile/?tab=plan"><?php echo $vi ? 'Thông tin gói' : 'Subscription plan' ?></a> -->

    <?php if($tab == 'profile') { ?>

   <form action="<?php echo $prefix ?>/profile/" method="post">
       <input name="type" value="profile" type="hidden"  />
    <div class="profile-item">
        <p><?php echo $vi ? 'Họ' : 'First name' ?></p>
        <input name="first_name" placeholder="First name" value="<?php echo $user->first_name ?>" />
    </div>
    <div class="profile-item">
        <p><?php echo $vi ? 'Tên' : 'Last name' ?></p>
        <input name="last_name" placeholder="Last name"  value="<?php echo $user->last_name ?>" />
    </div>
    <div class="profile-item">
        <p><?php echo $vi ? 'Email' : 'Email' ?></p>
        <input disabled placeholder="Email" value="<?php echo $user->user_email ?>" />
    </div>
    <div class="profile-item">
        <p><?php echo $vi ? 'Số điện thoại' : 'Phone' ?></p>
        <input name="phone"  placeholder="Phone"  value="<?php echo get_field('phone', 'user_'.$user->ID) ?>" />
    </div>
    <div style="text-align: right">
    <a href="/wp-login.php?action=logout"><?php echo $vi ? 'Thoát' : 'Logout' ?></a>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <button  class="btn" ><?php echo $vi ? 'Lưu lại' : 'Save change' ?></button>
    
   
    </div>
</form>

  
    <br />
    <form action="<?php echo $prefix ?>/profile/" method="post">
       <input name="type" value="password" type="hidden"  />
    <div class="profile-item">
        <p><?php echo $vi ? 'Mật khẩu cũ' : 'Old password' ?></p>
        <input name="old_password" type="password" required placeholder="Old  Password" />
    </div>
    <div class="profile-item">
        <p><?php echo $vi ? 'Mật khẩu mỡi' : 'New password' ?></p>
        <input name="new_password" type="password" minlength="8" required placeholder="Password" />
    </div>
    <div class="profile-item">
        <p><?php echo $vi ? 'Mật khẩu xác nhận' : 'Password confirm' ?></p>
        <input name="confirm_password" type="password"  minlength="8" required placeholder="Password" />
    </div>

    <div style="text-align: right">
    <?php
        if($passupdatetype == 'success'){
            echo '<span style="color: green">'.$passupdatemsg.'</span> ';
        }
        if($passupdatetype == 'errored'){
            echo '<span style="color: red">'.$passupdatemsg.'</span> ';
        }
     ?>
    &nbsp; &nbsp; &nbsp; &nbsp;
    <button class="btn" type="submit"><?php echo $vi ? 'Đổi mật khẩu' : 'Change password' ?></button>
    </div>
    <br />
    <br />
    <br />

</form>

<?php } ?>
    <?php  if($tab == 'plan') {
        $date_end_standard  = get_field('date_end_standard', 'user_'.$user->ID);
        $date_end_premium  = get_field('date_end_premium', 'user_'.$user->ID);
        ?>
        <?php if($date_end_standard) {  ?>
        <div class="plan">
            <p><?php echo $vi ? 'Gói' : 'Your plan' ?>: <b>Standard</p>
            <p><?php echo $vi ? 'Ngày hết hạn' : 'Expire date' ?>: <b><?php echo $date_end_standard ?></b> </p>
        </div>
        <?php } ?>
        <?php if($date_end_premium) {  ?>
        <div class="plan">
            <p><?php echo $vi ? 'Gói' : 'Your plan' ?>: <b>Premium </b></p>
            <p><?php echo $vi ? 'Ngày hết hạn' : 'Expire date' ?>: <b><?php echo $date_end_premium ?></b> </p>
        </div>
        <?php } ?>

        <?php if(!$date_end_premium  && !$date_end_standard ){
                echo $vi ? "<p>Bạn chưa mua gói, hãy theo dõi </p>" : "<p>You don't have any plan, let subscribe</p>";
            } ?>


        <br/>
        <br/>

        <div style="text-align: right">
        <?php if(!$date_end_premium && $date_end_standard) {  ?>
            <a  href="<?php echo $prefix ?>/payment?type=premium" class="button btn" ><?php echo $vi ? 'Năng cấp gói' : 'Upgrade plan' ?></a>
            &nbsp;
            &nbsp;
            &nbsp;

            <a href="<?php echo $prefix ?>/payment?type=standard" class="button btn" ><?php echo $vi ? 'Gia hạn gói' : 'Renew plan' ?></a>
            <?php } ?>

        <?php if($date_end_premium) {  ?>
            <a href="<?php echo $prefix ?>/payment?type=premium" class="button btn" ><?php echo $vi ? 'Gia hạn gói' : 'Renew plan' ?></a>
            <?php } ?>

            <?php if(!$date_end_premium  && !$date_end_standard ){
                echo $vi ?  '<a href="'.$prefix.'/subscribe" class="button" >Subscribe</a>' : '<a href="'.$prefix.'/subscribe" class="button" >Subscribe</a>';

            } ?>
    </div>

    <br/>
    <br/>
   
    <?php } ?>

    
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
