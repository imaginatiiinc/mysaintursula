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
                <h6>Search by Keyword</h6>
                <?php echo apply_filters('the_content', $content); ?>
                <form action="">                	
                	<input type="text" name="q" value="<?php echo $q ?>">
                	<input type="submit" value="Search">
                </form>
            </div>
        </div>
        <form style="border:1px solid #ddd; padding:1em; background:#ddd;">
          <div class="row">  
            <div class="col-lg-3">
                <h6>Filter by First Name</h6>
               <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_fields['first_name']; ?>">
            </div>
            <div class="col-lg-3">
                <h6>Filter by Last Name</h6>
                 <input type="text" class="form-control" id="marriedlast_name" name="marriedlast_name" value="<?php echo $user_fields['marriedlast_name']; ?>">
                	
            </div>
            <div class="col-lg-3">
                <h6>Filter by Class Year</h6>
                 <input type="text" class="form-control" id="class_year" name="class_year" value="<?php echo $user_fields['class_year']; ?>">
            </div>
              <div class="col-lg-3">
                  
              </div>
        </div>
        <div class="row">
            <div class="col-lg-3"><h6>Filter by City</h6><input type="text" class="form-control" id="city" name="city" value="<?php echo $user_fields['city']; ?>"></div>
            <div class="col-lg-3"><h6>Filter by State</h6><input type="text" class="form-control" id="state" name="state" value="<?php echo $user_fields['state']; ?>"></div>
            <div class="col-lg-3"><h6>Filter by Job Title</h6><input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $user_fields['job_title']; ?>"></div>
            <div class="col-lg-3"><h6>Filter by Industry</h6>                  <?php
                                                        $industry_field = get_field_object('field_5cf58a0763d85');
                                                        if( $industry_field['choices'] ): ?>
                                                            <select class="form-control" id="industry" name="industry">
                                                                <?php foreach( $industry_field['choices'] as $value => $label ): ?>
                                                                	<?php $selected = ($user_fields['industry']==$label)?'selected':'' ?>
                                                                    <option <?=$selected?>><?php echo $label; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                <?php endif; ?>  </div>
        </div> <input type="submit" value="Search"></form>       
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