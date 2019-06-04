<?php
$page_fields = get_fields();
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
	
function get_color($cat_title) {
	switch($cat_title) {
		case 'Academics':
			$color = get_field('academics','options');
			break;
		case 'Athletics':
			$color =get_field('athletics','options');
			break;
		case 'Catching Up':
			$color = get_field('catching_up','options');
			break;
		case 'Events':
			$color = get_field('events','options');
			break;
		case 'Obituaries':
			$color = get_field('obituaries','options');
			break;
		case 'Prayers Needed':
			$color = get_field('prayers_needed','options');
			break;
		case 'Student Life':
			$color = get_field('student_life','options');
			break;
		}
	return $color;
	}

?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
				
<?php
if(!empty($page_fields['banner_images'])) {
?>
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
<?php 
foreach ($page_fields['banner_images'] as $banner_image) {
?>

						<div class="item <?php if($banner_image == reset($page_fields['banner_images'])) echo 'active'; ?>">
						  <img src="<?= $banner_image['banner_image']['url']; ?>" />
						</div>
<?php
		}
?>
					  </div>

					  <!-- Left and right controls -->
					  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background: none;">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background: none;">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
					</div>
<?php
	}
?>
                </div>
            </div>
        </div>
    </header>

    <section style="padding-top: 50px">
        <div class="container">		
            <div class="row">
                <div class="col-lg-9">
                    <h2 style="color: <?php echo get_color(get_the_category($post->ID)[0]->name); ?>; margin-bottom: 0px;"><?php the_title(); ?></h2>
					<p class="post-meta">
						Posted in:
<?php
$categories = get_the_category();
$separator = ', ';
$output = '';
if ( ! empty( $categories ) ) {
    foreach( $categories as $category ) {
        $output .= '						<a style="color: rgb(1, 44, 95);" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
    }
    echo trim( $output, $separator );
}
?>
					on <?php the_date(); ?>
					</p>
					<hr />
					<?php the_content(); ?>
                </div>
                <div class="col-lg-3">
					<h4>Categories</h4>
					<ul style="color: <?php echo get_color(get_the_category($post->ID)[0]->name); ?>; padding-left: 25px;">
						<li><a href="<?php echo site_url( '/category/academics/'); ?>" style="color: rgb(1, 44, 95);">Academics</a></li>
						<li><a href="<?php echo site_url( '/category/athletics/'); ?>" style="color: rgb(1, 44, 95);">Athletics</a></li>
						<li><a href="<?php echo site_url( '/category/studentlife/'); ?>" style="color: rgb(1, 44, 95);">Student Life</a></li>
						<li><a href="<?php echo site_url( '/category/events/'); ?>" style="color: rgb(1, 44, 95);">Events</a></li>
						<li><a href="<?php echo site_url( '/category/birthscareersadoptions/'); ?>" style="color: rgb(1, 44, 95);">Catching Up</a></li>
						<li><a href="<?php echo site_url( '/category/prayersneeded/'); ?>" style="color: rgb(1, 44, 95);">Prayers Needed</a></li>
						<li><a href="<?php echo site_url( '/category/obituaries/'); ?>" style="color: rgb(1, 44, 95);">Obituaries</a></li>
					</ul>
						
                </div>
            </div>
        </div>
    </section>

<?php
endwhile; endif;
get_footer();
?>