<?php $page_fields = get_fields();
$title = get_the_title();
$content = get_the_content();
$cur_page = get_query_var( 'paged' ) ?: get_query_var( 'page' ) ?: 1; //get curent page

@$first_name = $_REQUEST['first_name'];
@$marriedlast_name = $_REQUEST['marriedlast_name'];
@$class_year = $_REQUEST['class_year'];
@$city = $_REQUEST['city'];
@$state = $_REQUEST['state'];
@$job_title = $_REQUEST['job_title'];
@$industry = $_REQUEST['industry'];
@$ohter_search = $_REQUEST['ohter_search'];

@$q = $_REQUEST['q'];

if($q === NULL && $ohter_search !== NULL){
	$meta_query = [
		'relation'		=> 'AND',
	];

	if($first_name){
		$meta_query[] = [
			'key'		=> 'first_name',
			'value'		=> $first_name,
			'compare'	=> 'LIKE'
		];
	}

	if($marriedlast_name){
		$meta_query[] = [
			'key'		=> 'marriedlast_name',
			'value'		=> $marriedlast_name,
			'compare'	=> 'LIKE'
		];
	}

	if($class_year){
		$meta_query[] = [
			'key'		=> 'class_year',
			'value'		=> $class_year,
			'compare'	=> 'LIKE'
		];
	}

	if($city){
		$meta_query[] = [
			'key'		=> 'city',
			'value'		=> $city,
			'compare'	=> 'LIKE'
		];
	}

	if($state){
		$meta_query[] = [
			'key'		=> 'state',
			'value'		=> $state,
			'compare'	=> 'LIKE'
		];
	}

	if($job_title){
		$meta_query[] = [
			'key'		=> 'job_title',
			'value'		=> $job_title,
			'compare'	=> 'LIKE'
		];
	}

	if($industry != 'None selected'){
		$meta_query[] = [
			'key'		=> 'industry',
			'value'		=> $industry,
			'compare'	=> 'LIKE'
		];
	}
}else{
	$meta_query = [
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
	];
}

$args = [
	'post_type'		=> 'purl',
	'post_status'	=> 'publish',
	'paged' 		=> $cur_page,
	'posts_per_page'=> -1,
	'meta_query'	=> $meta_query,
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

<section class="search_section_strt">
	<div class="container">		
		<div class="row">
			<div class="col-lg-12">
				<h6>Search by Keyword</h6>
				<?php echo apply_filters('the_content', $content); ?>
				<form action="/search2/" class="form_satr">                	
					<input type="text" name="q" value="<?php echo $q ?>" class="search_input">
					<input type="submit" value="Search" class="search_btn">
				</form>
			</div>
		</div>
		<form style="border:1px solid #ddd; padding:25px; background:#ddd;" action="/search2/" method="POST">
			<div class="row"> 
				<div class="col-lg-3">
					<h6>Filter by First Name</h6>
					<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
				</div>
				<div class="col-lg-3">
					<h6>Filter by Last Name</h6>
					<input type="text" class="form-control" id="marriedlast_name" name="marriedlast_name" value="<?php echo $marriedlast_name; ?>">

				</div>
				<div class="col-lg-3">
					<h6>Filter by Class Year</h6>
					<input type="text" class="form-control" id="class_year" name="class_year" value="<?php echo $class_year; ?>">
				</div>
				<div class="col-lg-3">

				</div>
			</div>
			<div class="row">
				<div class="col-lg-3"><h6>Filter by City</h6><input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>"></div>
				<div class="col-lg-3"><h6>Filter by State</h6><input type="text" class="form-control" id="state" name="state" value="<?php echo $state; ?>"></div>
				<div class="col-lg-3"><h6>Filter by Job Title</h6><input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $job_title; ?>"></div>
				<div class="col-lg-3"><h6>Filter by Industry</h6>                  <?php
					$industry_field = get_field_object('field_5cf58a0763d85');
					if( $industry_field['choices'] ): ?>
						<select class="form-control" id="industry" name="industry">
							<?php foreach( $industry_field['choices'] as $value => $label ): ?>
								<?php $selected = ($industry==$label)?'selected':'' ?>
								<option <?=$selected?>><?php echo $label; ?></option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>  
				</div>
			</div> 
			<input type="submit" value="Search" name="ohter_search" class="other_search">
		</form>       
	</div>
</section>

<?php if ( have_posts() ) : 
	while ( have_posts() ) : 
		the_post(); ?>
		<section>
			<div class="container">		
				<div class="row">
					<div class="col-lg-12">
						<p class="divider"></p>
						<h2 class="heading_search2"><a href="/profile/<?=get_the_ID()?>/details/" ><?php the_title(); ?></a></h2>
						<div class="row">
							<div class="col-sm-3">
								<div class="name_lable">
									<label>First name:</label>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="name_details_">
									<p> <?php the_field('first_name'); ?></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3">
								<div class="name_lable">
									<label>Middle name:</label>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="name_details_">
									<p> <?php the_field('maiden_name'); ?></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3">
								<div class="name_lable">
									<label>Married/last name:</label>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="name_details_">
									<p> <?php the_field('marriedlast_name'); ?></p>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3">
								<div class="name_lable">
									<label>Class year:</label>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="name_details_">
									<p><?php the_field('class_year'); ?></p>
								</div>
							</div>
						</div>
						
						 
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