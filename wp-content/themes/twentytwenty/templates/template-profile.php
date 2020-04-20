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
    <h4>Manage your account</h4>
    <br />

    <div class="profile-tab active">Profile</div>
    <div class="profile-tab ">Subscription plan</div>

   
    <div class="profile-item">
        <p>First name</p>
        <input placeholder="First name" />
    </div>
    <div class="profile-item">
        <p>Last name</p>
        <input placeholder="Last name" />
    </div>
    <div class="profile-item">
        <p>Email</p>
        <input disabled placeholder="Email" />
    </div>
    <div class="profile-item">
        <p>Phone</p>
        <input placeholder="Phone" />
    </div>
    <div style="text-align: right">
    <a href="/wp-login.php?action=logout">Logout</a>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <button>Save change</button>
    
   
    </div>
    <br />
    <div class="profile-item">
        <p>Old Password</p>
        <input placeholder="Old  Password" />
    </div>
    <div class="profile-item">
        <p>Password</p>
        <input placeholder="Password" />
    </div>
    <div class="profile-item">
        <p>Password confirm</p>
        <input placeholder="Password" />
    </div>

    <div style="text-align: right">
    <button>Change password</button>
    </div>
    <br />
    <br />
    <br />

    
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
