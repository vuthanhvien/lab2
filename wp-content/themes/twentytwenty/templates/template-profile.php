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


get_header();
?>

<main id="site-content" role="main">
<div class="section-inner" >
<div class="profile">
    <h4>Profile</h4>
    <p>
    <a href="/wp-login.php?action=logout">Logout</a>
</p>
<pre>
    <?php
    
    echo json_encode($user, JSON_PRETTY_PRINT);
    $fields =  get_fields('user_'.$user->ID);

    var_dump($fields);
    ?>
    </pre>

    <a href="/payment" >Payment</a>

<p class="auth-redirect">

</p>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
