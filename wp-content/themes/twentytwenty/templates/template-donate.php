<?php
/**
 * Template Name: Donate Template
 * Template Post Type:  page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
 
get_header();
?>

<main id="site-content" role="main"> 
<div class="donate" >

<?php  the_content() ?>
<div class="section-inner" >

<h4>Donate via VNpay</h4>
<h5>Select amount</h5>

<ul>
    <li>
       <a class="donate-amount active" data-amount="20"> 20$</a>
    </li>
    <li>
    <a class="donate-amount" data-amount="50"> 50$</a>
    </li>
    <li>
    <a class="donate-amount" data-amount="100"> 100$</a>
    </li>
    <li>
    <a class="donate-amount" data-amount="200"> 200$</a>
    </li>
    <li>
        <input  style="text-align:right; font-size: 18px; height: 62px" id="donate-amount-custom" placeholder="Custom" type="number" />
    </li>
</ul>
<h5>Your information</h5>
<label>Title</label>
<select required name="title" >
<option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option><option value="Prof">Prof</option>
</select>
<br />
<label>Full name</label>
<input name="full_name" required placehollder="Full name" type="text" />
<br />
<label>Email</label>
<input name="email" required placehollder="Email"  type="email"  />
<br />
<br />
<h5 style="text-weight: bold" id="donate-total"></h5>
<br />
<button id="submit" type="submit" class="button btn">Make payment via VNPAY</button>


<br />
<br />
<br />
<br />


</div>
</div>
</main><!-- #site-content -->

<script>
    var amount = 20;

    jQuery('.donate-amount').click(function(){
        jQuery('.donate-amount').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('#donate-amount-custom').val('');
        amount =  jQuery(this).data('amount');
        jQuery('#donate-total').html('Total: '+amount*1+'$')
    })

    jQuery('#donate-amount-custom').keyup(function(){
        jQuery('.donate-amount').removeClass('active');
        var val = jQuery(this).val();
        jQuery('#donate-total').html('Total: '+val *1 +'$')
    })
    //  init 
    jQuery('#donate-total').html('Total: '+amount*1+'$')
    //else 
    $("#submit").click(function () {
        var fullName = jQuery('.donate *[name=full_name]').val();
        var email = jQuery('.donate *[name=email]').val();
            $.ajax({
                type: "POST",
                url: '/vnpay-donate.php',
                data: {
                    amount: amount,
                    info: 'Tên: '+fullName + ' | Email'+ email
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

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
