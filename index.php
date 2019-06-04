<?php
$page_fields = get_fields();
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();

if(wp_get_post_parent_id( $post->ID )) {
	$children = get_pages('child_of='.wp_get_post_parent_id( $post->ID ).'&sort_column=post_title');
	}
else {
	$children = get_pages('child_of='.$post->ID.'&sort_column=post_title');
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

    <section>
        <div class="container">
<?php
if(!empty($children)) {
?>
            <div class="row">
                 <div class="col-lg-12">
					<div style="text-align: center; margin-bottom: 60px; font-size: 24px; color: rgb(254, 205, 51); font-weight: 700;">
						<span style="white-space: nowrap;">
							<a href="http://www.mysaintursula.com/weddings/contract" style="color: rgb(1, 44, 95);">Contract</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/directions" style="color: rgb(1, 44, 95);">Directions</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/faqs" style="color: rgb(1, 44, 95);">FAQs</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="https://www.saintursulaevents.com/final-wedding-details/" style="color: rgb(1, 44, 95);">Final Details</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/parking" style="color: rgb(1, 44, 95);">Parking</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/priestsfloristsmusicians" style="color: rgb(1, 44, 95);">Priests, Florists & Musicians</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/resources" style="color: rgb(1, 44, 95);">Resources</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
							<a href="http://www.mysaintursula.com/weddings/timelimits" style="color: rgb(1, 44, 95);">Time Limits</a>
						</span>
					</div>
				</div>
			</div>
<?php } ?>
		
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

<?php
endwhile; endif;
get_footer();
?>