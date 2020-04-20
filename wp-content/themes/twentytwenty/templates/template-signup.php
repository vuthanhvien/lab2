<?php
/**
 * Template Name: Signup Template
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

if($_GET['user_name'] && $_GET['user_email']){
    $username=$_GET['user_name'];
    $useremail=$_GET['user_email'];
}

if (isset($_POST['user_registeration']))
{
    //registration_validation($_POST['username'], $_POST['useremail']);
    global $reg_errors;
    $reg_errors = new WP_Error;
    $username=$_POST['username'];
    $useremail=$_POST['useremail'];
    $password=$_POST['password'];
    
    
    if(empty( $username ) || empty( $useremail ) || empty($password))
    {
        $reg_errors->add('field', 'Required form field is missing');
    }    
    if ( 6 > strlen( $username ) )
    {
        $reg_errors->add('username_length', 'Username too short. At least 6 characters is required' );
    }
    if ( username_exists( $username ) )
    {
        $reg_errors->add('user_name', 'The username you entered already exists!');
    }
    if ( ! validate_username( $username ) )
    {
        $reg_errors->add( 'username_invalid', 'The username you entered is not valid!' );
    }
    if ( !is_email( $useremail ) )
    {
        $reg_errors->add( 'email_invalid', 'Email id is not valid!' );
    }
    
    if ( email_exists( $useremail ) )
    {
        $reg_errors->add( 'email', 'Email Already exist!' );
    }
    if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5!' );
    }
    
    if (is_wp_error( $reg_errors ))
    { 
        foreach ( $reg_errors->get_error_messages() as $error )
        {
             $signUpError='<p class="text-error"><strong>ERROR</strong>: '.$error . '<br /></p>';
        } 
    }
    
    
    if ( 1 > count( $reg_errors->get_error_messages() ) )
    {
        // sanitize user form input
        global $username, $useremail;
        $username   =   sanitize_user( $_POST['username'] );
        $useremail  =   sanitize_email( $_POST['useremail'] );
        $password   =   esc_attr( $_POST['password'] );
        
        $userdata = array(
            'user_login'    =>   $username,
            'user_email'    =>   $useremail,
            'user_pass'     =>   $password,
            );
        $user = wp_insert_user( $userdata );
    wp_redirect('/profile');
    }

}



get_header();
?>

<main id="site-content" role="main">
<div class="auth-page" >
<div class="section-inner" >
<div class="form">
<h4>Create your account</h4>
    <?php if(isset($signUpError)){echo '<p class="text-error">'.$signUpError.'</p>';}?>
    <form action="/signup" method="post" name="user_registeration">
        <input type="text" value="<?php echo $username; ?>" name="username" placeholder="Enter Your Username" class="text" required />
        <input type="text" value="<?php echo $useremail; ?>" name="useremail" class="text" placeholder="Enter Your Email" required /> 
        <input type="password" value="<?php echo $password; ?>" name="password" class="text" placeholder="Enter Your password" required />
        <button type="submit" id="wp-submit" name="user_registeration">SignUp</button>
        <!-- <input type="submit" name="user_registeration" value="SignUp" /> -->
    </form>

<p class="auth-redirect">
<a></a>
<a href="/login">Login</a>

</p>
</div>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
