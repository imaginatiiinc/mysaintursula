<?php $page_fields = get_fields();
get_header(); ?>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">				
				<?php if(!empty($page_fields['banner_images'])) { ?>
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Wrapper for slides -->
					  	<div class="carousel-inner" role="listbox">
							<?php foreach ($page_fields['banner_images'] as $banner_image) { ?>
								<div class="item <?php if($banner_image == reset($page_fields['banner_images'])) echo 'active'; ?>">
									<img src="<?= $banner_image['banner_image']['url']; ?>" />
								</div>
							<?php } ?>
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
				<?php } ?>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="container">		
        <div class="row">
            <div class="col-lg-12">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php 
error_reporting(1);
ini_set('display_errors', 1);
$form_id =  absint( 12 );
$entries   = GFAPI::get_entries($form_id ); ?>

<ul>
	<?php foreach ($entries as $key => $entry) : ?>
		<li>
			<?= "$entry[1] $entry[2], $entry[3], $entry[5], $entry[6], $entry[7], $entry[8]" ?>
		</li>
	<?php endforeach; ?>
</ul>

<?php get_footer(); ?>