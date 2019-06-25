<?php $page_fields = get_fields();
$title = get_the_title();
$content = get_the_content();

$cur_page = get_query_var( 'paged' ) ?: get_query_var( 'page' ) ?: 1; //get curent page
$q = $_GET['q'];
$args = [
	'post_type'		=> 'purl',
	'post_status'	=> 'publish',
	'paged' 		=> $cur_page,
	'posts_per_page'=> -1,
	'meta_query'	=> [
		'relation'		=> 'OR',
		[
			'key'		=> 'first_name',
			'value'		=> $q,
			'compare'	=> 'LIKE'
		],
		[
			'key'		=> 'maiden_name',
			'value'		=> $q,
			'compare'	=> 'LIKE'
		],
		[
			'key'		=> 'marriedlast_name',
			'value'		=> $q,
			'compare'	=> 'LIKE'
		],
		[
			'key'		=> 'class_year',
			'value'		=> $q,
			'compare'	=> '='
		],
	]
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

<section>
    <div class="container">		
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo apply_filters('the_title', $title); ?></h2>
                <?php echo apply_filters('the_content', $content); ?>
                <form action="">                	
                	<input type="text" name="q" value="<?php echo $q ?>">
                	<input type="submit" value="Search">
                </form>
            </div>
        </div>
    </div>
</section>

<?php if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post(); ?>
	    <section>
	        <div class="container">		
	            <div class="row">
	                <div class="col-lg-12">
	                    <h2><?php the_title(); ?></h2>
						First name: <?php the_field('first_name'); ?> <br>
						Middle name: <?php the_field('maiden_name'); ?> <br>
						Married/last name: <?php the_field('marriedlast_name'); ?> <br>
						Class year: <?php the_field('class_year'); ?> <br>
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
endif;
get_footer(); ?>