<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = urlencode($actual_link);

?>

<main id="site-content" class="job" role="main">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			$companyId = get_field('company');

			$industry = get_field('industry') ? join(', ', get_field('industry')) : '';
			$type = get_field('type') ? join(', ', get_field('type')) : '';
			$function = get_field('function') ? join(', ', get_field('function')) : '';
			$experiences = get_field('experience') ? join(', ', get_field('experience')) : '';

			$skills = get_field('skills') ? explode(',', get_field('skills')) : array();


			?>
				<div class="job-header" style="background: white; padding: 30px 0">
					<div class="section-inner">
						<div class="job-logo">
							<img src="<?php echo get_field('logo',$companyId ) ?>" />
						</div>
						<div class="job-text">
							<h4><?php the_title() ?></h4>
							<h5 class="blue"><?php echo get_the_title($companyId) ?></h5>
							<h5><?php echo join(', ', get_field('location')) ?></h5>
							<h5 class="blue"><?php echo  get_field('salary') ?></h5>
							<p ><i class="fa fa-clock"></i> Date created: <strong><?php  echo get_the_date() ?></strong> &nbsp;&nbsp;<i class="fa fa-clock"></i> Date updated: <strong><?php the_modified_date() ?> </strong> </p>
						</div>
						<hr style="margin: 20px 0" />
						<p>
						Function: <strong><?php echo $industry ?></strong> &nbsp;&nbsp;
						Type:<strong> <?php echo $type ?></strong> &nbsp;&nbsp;
						Experience: <strong><?php echo $experiences ?></strong> &nbsp;&nbsp;
						Industry: <strong><?php echo $industry ?></strong> &nbsp;&nbsp;
						Vacancies: <strong><?php echo get_field('vacancies') ?></strong>
						</p>
						<hr style="margin: 20px 0" />

						<div style="text-align: right">
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link ?>">Share this job</a>
							&nbsp;
							&nbsp;
							&nbsp;
							<button id="apply-job" style="padding: 15px 20px; font-size: 16px">Apply this job</button>
						</div>
					</div>
				</div>
				<div class="section-inner job-main"  >
					<div class="job-content">
					 	<div class="job-block">
							<div class="job-block-header">
								Job description & requirements
							</div>
							<div class="job-block-body">
								<?php the_content() ?>
							</div>
						</div>
						<div class="job-block">
							<div class="job-block-header">
								Required skills
							</div>
							<div class="job-block-body">
							<div class="skills">
								<?php 
									foreach($skills as $skill){
										echo  '<div class="skill">'.$skill.'</div>';
									}
								?>
							</div>
							</div>
						</div>

						<div class="job-block">
							<div class="job-block-header">
								Culture
							</div>
							<div class="job-block-body">
								<?php echo get_field('culture') ?>
							</div>
						</div>

					</div>
					<div class="job-info">
						<p style="text-align: justify"><?php echo get_field('description', $companyId) ?></p>
						<br />
						<p><?php echo join(', ', get_field('location', $companyId)) ?></p>
						<p><?php echo get_field('type',$companyId) ?></p>
						<p><?php echo get_field('description',$companyId) ?></p>
						<p><?php echo get_field('total_employees',$companyId) ?></p>
						<hr style="margin: 15px 0" />
						<a href="<?php the_permalink($companyId) ?>">COMPANY PROFILE <i class="fa fa-long-arrow-right"></i></a>

						<br />
						<h5 style="font-size: 18px">Similar jobs</h5>
						<hr style="margin: 15px 0" />
						<?php
						
						$param = array(
							'paged'         => $paged, 
							'order'         => 'desc',
							'post_status'   => 'publish',
							'posts_per_page'=> 10,
							'offset'       	=> 0,
							'post_type'		=> 'job',
							'orderby'		=> 'date',
						);
				
						$query = new WP_Query($param);
						if ($query->have_posts()) {
							while ($query->have_posts()) { 
								$query->the_post(); 
								$companyId = get_field('company');
								?>

								<div class="job-similar" style="min-height: 100px; padding: 20px 0">
								<img width="50px" style="float:left;margin-top: 20px" src="<?php echo get_field('logo',$companyId ) ?>" />
								<div class="job-similar-content" style="padding-left: 60px">
									<a href="<?php the_permalink() ?>"><p style="font-size: 16px; color: #555"><b><?php the_title() ?></b><p></a>
									<p style="font-size: 14px; color: #0D87D0"><?php echo get_the_title($companyId) ?><p>
									<p  style="font-size: 14px; color: #555"><?php echo join(', ', get_field('location', $companyId)) ?></p>
									<p  style="font-size: 14px; color: #0D87D0"><?php echo get_field('salary') ?></p>
									<p  style="font-size: 14px; color: #555"><i class="fa fa-clock"></i> <?php echo get_the_date() ?></p>
								</div>
								</div>

								<?php
							}
						}
						
							
						?>
						<hr style="margin: 15px 0" />
						<a href="/jobs">MORE JOB <i class="fa fa-long-arrow-right"></i></a>

					</div>
				</div>	
			<?php
		}
	}
	?>
	<style>
	.job-info p{
		font-size: 16px;
	}
	.skills .skill{
		display: inline-block;
		margin: 5px;
		padding: 5px 20px;
		font-size: 	13px;
		background: #eee;
		border-radius: 10px;
		font-weight: bold;
		color: #555;
	}
	.job-main{
		padding: 40px 0;
	}
	.job-block-header{
		padding: 20px;
		font-size: 18px;
		border-bottom: 1px solid #ccc;
		font-weight: bold;
	}
	.job-block-body{
		padding: 20px;
		font-size: 16px;
	}
	.job-block-body h4{
		font-size: 18px;
	}
	.job-block-body p,
	.job-block-body span,
	.job-block-body li,
	.job-block-body p{
		font-size: 16px;

	}

	.job-block{
		background: white;
		margin-bottom: 40px;
		box-shadow: 0 0 10px rgba(0,0,0,0.1)
	}

	.job-header{
		box-shadow: 0 0 10px rgba(0,0,0,0.1)
	}
	.job-content{
		display: inline-block;
		width: 75%;
	}
	.job-info{
		display: inline-block;
		width: 24%;
		vertical-align: top;
		padding-left: 30px;
	}
	
	.job-header .job-text h4{
		font-size: 24px;
	}


	.job-header .job-text h5{
		font-size: 18px;
		margin: 10px 0;
		color: #555;
	}
	.job-header .job-text h5.blue{
		color: #0D87D0;
	}
	.job-header p{
		color: #555;
		font-size: 16px;
	}
	.job-logo{
		float: left;
		width: 150px;
	}
	.job-text{
		padding-left: 170px;
	}
	
	</style>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>


<?php echo do_shortcode('[contact-form-7 id="1476" title="Candidate"]'); ?>

<?php get_footer(); ?>
