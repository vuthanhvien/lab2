<?php
/**
 * Template Name: Forgot Template
 * Template Post Type:  page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

$user = wp_get_current_user();
if($user->exists()){
    wp_redirect('/profile');
}



if(isset($_GET['key']) && $_GET['action'] == "reset_pwd") { 
    $reset_key = $_GET['key'];
    $user_login = $_GET['login'];
    $user_data = $wpdb->get_row("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = '".$reset_key."' AND user_login = '". $user_login."'");
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    if(!empty($reset_key) && !empty($user_data)) {
        if ( kv_rest_setting_password($reset_key, $user_login, $user_email, $user_data->ID) ) {
            $errors['emailError'] = "Email failed to sent for some unknown reason"; 
        }
        else {
            $redirect_to = get_site_url()."/login?action=reset_success";
            wp_safe_redirect($redirect_to);
            exit();
        }
    }
    else exit('Not a Valid Key.'); 
}



if(isset($_POST['user_forgot'])) {
    //Here our code for reset.

    if ( isset($_POST['useremail']) && empty($_POST['useremail']) ){

    
            $errors['userName'] = __("<strong>ERROR</strong>: Username/e-mail Shouldn't be empty.");
    }
        else{
            $useremail = $_POST['useremail']; 
            $user_input = esc_sql(trim($useremail));

            if ( strpos($user_input, '@') ) {
                $user_data = get_user_by( 'email', $user_input ); 
                if(empty($user_data) ) {
                    $errors['invalid_email'] = 'Invalid E-mail address!'; 
                }
           } else {
                $user_data = get_user_by( 'login', $user_input ); 
                if(empty($user_data) ) { 
                    $errors['invalid_username'] = 'Invalid Username!'; 
                }
           }

        }

        if(empty($errors)) { 
            if(kv_forgot_password_reset_email($user_data->user_email)) {
                 $success['reset_email'] = "We have just sent you an email with Password reset instructions.";
            } else {
                 $errors['emailError'] = "Email failed to send for some unknown reason."; 
            } //emailing password change request details to the user 
       }

        if($errors) {
            foreach ( $errors as $error )
        {
             $forgotError='<p class="text-error"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    } 
        if($success) {
            foreach ( $success as $s )
            {
                 $forgotSuccess='<p class="text-success"><strong>SUCCESS</strong>: '.$s . '<br /></p>';
            } 
        }
        


}




get_header();
?>

<main id="site-content" role="main">
<div class="auth-page" >
<div class="section-inner" >
<div class="form">
<h4>Forgot password</h4>
    <?php if(isset($forgotError)){echo $forgotError ;}?>
    <?php if(isset($forgotSuccess)){echo $forgotSuccess ;}?>
    <form action="/forgot-password" method="post" name="user_forgot">
        <input type="text" value="<?php echo $user_input; ?>" name="useremail" class="text" placeholder="Enter Your Email" required /> 
        <button type="submit" id="wp-submit" name="user_forgot">Send code to my email</button>
    </form>

<p class="auth-redirect">
<a href="/login"></a>
<a href="/login">Login</a>

</p>
</div>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
