<?php
/**
 * Template Name: Login Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

$user = wp_get_current_user();
if($user->exists()){
    wp_redirect('/profile');
}

$action = (isset($_GET['action']) ) ? $_GET['action'] : '';

get_header();
?>

<main id="site-content" role="main">
<div class="auth-page" >
<div class="section-inner" >
<div class="form">
    <h4>Welcome back!</h4>

<?php 

if($action == 'reset_success'){
    echo '<p class="text-success">Your new password sent your email</p>';
}

$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
if ( $login === "failed" ) {
        echo '<p class="text-error"><strong>ERROR:</strong> Username or password invalid.</p>';
} elseif ( $login === "empty" ) {
        echo '<p class="text-error"><strong>ERROR:</strong> Username or password not empty.</p>';
} elseif ( $login === "false" ) {
        echo '<p class="text-error"><strong>ERROR:</strong> You logouted.</p>';
}


$args = array(
    'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
    'form_id'        => 'login-form', //Để dành viết CSS
    'label_username' => __( 'Tên tài khoản' ),
    'label_password' => __( 'Mật khẩu' ),
    'label_remember' => __( 'Ghi nhớ' ),
    'label_log_in'   => __( 'Login now' ),
    'echo' => false,
);
$form = wp_login_form($args);
$form = str_replace('name="log"', 'name="log" placeholder="Your email"', $form);
$form = str_replace('name="pwd"', 'name="pwd" placeholder="Password"', $form);

echo $form;

?>

<p class="auth-redirect">
<a href="/forgot">Forgot password?</a>
<a href="/signup">Create new account</a>

</p>
</div>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
