<?php
get_header();

// $args = array ( 'category' => get_cat_ID(single_cat_title('', false)), 'posts_per_page' => -1);
// $posts = get_posts( $args );


$sticky = get_option( 'sticky_posts' );
$query = new WP_Query( array( 'post__in'  => $sticky, 'cat' => get_cat_ID(single_cat_title('', false)), 'posts_per_page' => -1  ) );
$posts1 = $query->posts;

$query = new WP_Query( array( 'post__not_in'  => $sticky, 'cat' => get_cat_ID(single_cat_title('', false)), 'posts_per_page' => -1  ) );
$posts2 = $query->posts;

$posts = array_merge($posts1, $posts2);

foreach ($posts as $post) {
        $post_end_date = get_field('post_end_date', $post->ID);
        if(!empty($post_end_date)) {
                if(strtotime($post_end_date) >= time()) {
                        $filtered_posts[] = $post;
                        }
                else {
                      	// do nothing
                        }
                }
        else {
              	$filtered_posts[] = $post;
                }
        }

$posts = $filtered_posts;

switch(single_cat_title('', false)) {
	case 'Academics':
			$color = get_field('academics','options');
			break;
		case 'Athletics':
			$color =get_field('athletics','options');
			break;
		case 'Alumnae Updates':
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
?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<!--<img src="http://placehold.it/1140x450">-->
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<div style="text-align: center; margin-bottom: 60px; font-size: 20px; color: rgb(254, 205, 51); font-weight: 700;">
						<span style="white-space: nowrap;">
							<a href="<?php echo site_url(); ?>" style="color: <?php echo get_field('all','options'); ?>;">All</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/academics/'); ?>" style="color: <?php echo get_field('academics','options'); ?>">Academics</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/athletics/'); ?>" style="color: <?php echo get_field('athletics','options'); ?>">Athletics</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/studentlife/'); ?>" style="color: <?php echo get_field('student_life','options'); ?>">Student Life</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/events/'); ?>" style="color: <?php echo get_field('events','options'); ?>;">Events</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/birthscareersadoptions/'); ?>" style="color: <?php echo get_field('catching_up','options'); ?>">Alumnae Updates</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/prayersneeded/'); ?>" style="color: <?php echo get_field('prayers_needed','options'); ?>">Prayers Needed</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/obituaries/'); ?>" style="color: <?php echo get_field('obituaries','options'); ?>">Obituaries</a>
						</span>
					</div>
				</div>
			</div>
			<div class="row">
                <div class="col-lg-12">
                    <h2 style=" color: <?php echo $color;?>;"><?php single_cat_title(); ?></h2>
					<hr/>
<?php
if(!empty($posts)) {
?>
					<div class="row">
<?php

	if(!empty($posts[0])) {
		$fields = get_fields($posts[0]->ID);
?>
						<a href="<?php echo site_url('/' . $posts[0]->post_name . '/'); ?>">
							<div class="col-lg-6" style="background-color: <?=$color;?>; height: 400px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
								<h1 style="color: white; text-align: center; position: relative; top: 40%; margin-top: 0px; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[0]->post_title; ?></h1>
							</div>
						</a>
<?php
		unset($posts[0]);
		}
		
	if(!empty($posts[1])) {
		$fields = get_fields($posts[1]->ID);
?>
						<div class="col-lg-6">
							<div class="row">
								<a href="<?php echo site_url('/' . $posts[1]->post_name . '/'); ?>">
									<div class="col-lg-6" style="background-color: <?=$color;?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; position: relative; top: 30%; margin-top: 0px; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[1]->post_title; ?></h3>
									</div>
								</a>
<?php
		unset($posts[1]);
		if(!empty($posts[2])) {
			$fields = get_fields($posts[2]->ID);
?>
								<a href="<?php echo site_url('/' . $posts[2]->post_name . '/'); ?>">
									<div class="col-lg-6" style="background-color: <?=$color;?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; position: relative; top: 30%; margin-top: 0px; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[2]->post_title; ?></h3>
									</div>
								</a>
<?php
			unset($posts[2]);
			}
?>

<?php
		if(!empty($posts[3])) {
			$fields = get_fields($posts[3]->ID);
?>
								<a href="<?php echo site_url('/' . $posts[3]->post_name . '/'); ?>">
									<div class="col-lg-6" style="background-color: <?=$color;?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; position: relative; top: 30%; margin-top: 0px; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[3]->post_title; ?></h3>
									</div>
								</a>
<?php
			unset($posts[3]);
			}
?>

<?php
		if(!empty($posts[4])) {
			$fields = get_fields($posts[4]->ID);
?>
								<a href="<?php echo site_url('/' . $posts[4]->post_name . '/'); ?>">
									<div class="col-lg-6" style="background-color: <?=$color;?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; position: relative; top: 30%; margin-top: 0px; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[4]->post_title; ?></h3>
									</div>
								</a>
<?php
			unset($posts[4]);
			}
?>


							</div>
						</div>
<?php
		}
?>
					</div>
					<hr/>
					
<?php
foreach ($posts as $post) {
	$fields = get_fields($post->ID);
?>
					<div class="row" style="margin-top: 20px;">
						<div class="col-lg-12">
							<div class="post-preview">
								<a href="<?php echo site_url('/' . $post->post_name . '/'); ?>" style=" color: <?=$color;?>; text-decoration: none;">
									<h2 class="post-title" style="margin-bottom: 0px; font-size: 30px; color: <?=$color;?>;"><?php echo $post->post_title; ?></h2>
									<p style="margin-bottom: 0px;"><?php echo $post->post_excerpt; ?></p>
								</a>
								<p class="post-meta">Posted in: <a href="<?php get_category_link(get_the_category($post->ID)[0]->cat_ID); ?>" style="color: <?=$color;?>;"><strong><?php echo get_the_category($post->ID)[0]->name; ?></strong></a></p>
							</div>
						</div>
					</div>
					<hr/>

<?php
		}

	}
?>








                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
?>
