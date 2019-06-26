<?php 
$args = [
	'post__in'		=> [get_query_var('purl_id', null)],
	'post_type' => 'purl',
	'post_status' => 'publish',
];
query_posts($args);
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

<?php if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post(); ?>
		<section>
			<div class="container">		
				<div class="row">
					<div class="col-lg-12">
						<h2><?php the_title(); ?></h2>
						<?php foreach (get_field_objects() as $key => $field): ?>
							<?php if ($field['type']!='checkbox' && !empty($field['value'])): ?>
								<?=$field['label']?>: 
								<?php if ($field['type']=='checkbox'): ?>
									<?=$field['value']?'YES':'NO'?>
								<?php elseif ($field['type']=='select' && is_array($field['value'])): ?>
									<?=implode(', ', $field['value']) ?>
								<?php else: ?>
									<?=$field['value']?>
								<?php endif ?>
								<br>
							<?php endif ?>
								
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; 
	/*the_posts_pagination(
		[
			'prev_text'  => '<span class="screen-reader-text">Previous page</span>',
			'next_text'   => '<span class="screen-reader-text">Next page</span>',
			'before_page_number' => '<span class="meta-nav screen-reader-text">Page </span>',
		]
	);*/
else: ?>
	<section>
		<div class="container">		
			<div class="row">
				<div class="col-lg-12">
					<h2>No result found</h2>
				</div>
			</div>
		</div>
	</section> 
<?php endif;
get_footer(); ?>