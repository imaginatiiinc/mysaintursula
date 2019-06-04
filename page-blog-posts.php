<?php
/* 
 * Template Name: CustomBlogPage
 */

$page_fields = get_fields();
$user_fields = get_fields($_SESSION['level10']['purl_id']);
$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1  ) );
$posts = $query->posts;
/*echo "<pre>";
print_r($posts);die;*/
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
function get_color($cat_title) {
	switch($cat_title) {
		case 'Academics':
			$color = '#009ca6';
			break;
		case 'Campus Ministry':
			$color = '#981d97';
			break;
		case 'Athletics':
			$color = '#00b5e2';
			break;
		case 'Fine Arts':
			$color = '#00A1AA';
			break;
		case 'Student Activities':
			$color = '#d0006f';
			break;
		case 'Alumnae Spotlight':
			$color = '#ffc72c';
			break;
		}
	return $color;
	}

get_header();
?>
<style>
.whiteborder{border:1px solid white;}
.fa-fw {
    width: 1.28571429em;
    text-align: center;
    line-height: 45px !important;
}
</style>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<?php 
					$decades = get_field('decade_banners', 'option');
					if(!empty($user_fields['class_year'])) {
						foreach ($decades as $decade) {
							if($user_fields['class_year'] >= $decade['decade_start_year'] && $user_fields['class_year'] <= $decade['decade_end_year']) {
								$banner_image = $decade['image']['url'];
								break;
								}
							}
						}
					
					if(empty($banner_image) && !empty($page_fields['banner_image']['url'])) {
						$banner_image = $page_fields['banner_image']['url'];
						}
						
					if(!empty($banner_image)) {
					?>

						<img src="<?php echo $banner_image; ?>" style="width: 1140px" class="img-responsive" />
					<?php } ?>
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
							<a href="<?php echo site_url(); ?>" style="color: rgb(1, 44, 95);">All</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/academics/'); ?>" style="color: <?php echo get_color('Academics');?> ;">Academics</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/campusministry/'); ?>" style="color: <?php echo get_color('Campus Ministry');?>;">Campus Ministry</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/athletics/'); ?>" style="color: <?php echo get_color('Athletics');?>;">Athletics</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/finearts/'); ?>" style="color: <?php echo get_color('Fine Arts');?>;">Fine Arts</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/studentlife/'); ?>" style="color: <?php echo get_color('Student Activities');?>;">Student Activities</a>
						</span>
						<span style="white-space: nowrap;">
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url( '/category/alumnaespotlight/'); ?>" style="color: <?php echo get_color('Alumnae Spotlight');?>;">Alumnae Spotlight</a>
						</span>
					</div>
				</div>
			</div>
			
			<div class="row">
                <div class="col-lg-12">
<?php
if(!empty($posts)) {
?>
					<div class="row">
<?php

	if(!empty($posts[0])) {
		$fields = get_fields($posts[0]->ID);
		//echo "<pre>";print_r($fields);die;
		
?>
						<a href="<?php echo site_url('/' . $posts[0]->post_name . '/'); ?>">
							<div class="col-lg-6 whiteborder" style="display:table;background-color: <?php echo get_color(get_the_category($posts[0]->ID)[0]->name); ?>; height: 400px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
								<h1 style="color: white; text-align: center; display:table-cell;vertical-align: middle; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[0]->post_title; ?></h1>
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
									<div class="col-lg-6 whiteborder" style="display:table;background-color: <?php echo get_color(get_the_category($posts[1]->ID)[0]->name); ?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center;display:table-cell;vertical-align: middle;  text-shadow: 2px 2px 4px #000000;"><?php echo $posts[1]->post_title; ?></h3>
									</div>
								</a>
<?php
		unset($posts[1]);
		if(!empty($posts[2])) {
			$fields = get_fields($posts[2]->ID);
?>
								<a href="<?php echo site_url('/' . $posts[2]->post_name . '/'); ?>">
									<div class="col-lg-6 whiteborder" style="display:table;background-color: <?php echo get_color(get_the_category($posts[2]->ID)[0]->name); ?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; display:table-cell;vertical-align: middle; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[2]->post_title; ?></h3>
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
									<div class="col-lg-6 whiteborder" style="display:table;background-color: <?php echo get_color(get_the_category($posts[3]->ID)[0]->name); ?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center; display:table-cell;vertical-align: middle; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[3]->post_title; ?></h3>
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
									<div class="col-lg-6 whiteborder" style="display:table;background-color: <?php echo get_color(get_the_category($posts[4]->ID)[0]->name); ?>; height: 200px; background-repeat: no-repeat; background-size: cover; <?php if(!empty($fields['featured_image']['url'])) echo 'background-image: url(' . $fields['featured_image']['url'] . ');';?>">
										<h3 style="color: white; text-align: center;display:table-cell;vertical-align: middle; text-shadow: 2px 2px 4px #000000;"><?php echo $posts[4]->post_title; ?></h3>
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
/*$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 20  ) );
$posts = $query->posts;*/
$counter = 0;
$hidden = "";
foreach ($posts as $post) {
	$fields = get_fields($post->ID);
$counter++;
//echo $counter;
if ($counter > 5) {
//  $hidden = "hidden";
//}
?>
					<div class="row <?php echo $hidden;?>" style="margin-top: 20px;">
						<div class="col-lg-12">
							<div class="post-preview">
								<a href="<?php echo site_url('/' . $post->post_name . '/'); ?>" style=" color: <?php echo get_color(get_the_category($post->ID)[0]->name); ?>; text-decoration: none;">
									<h2 class="post-title" style="margin-bottom: 0px; font-size: 30px; color: <?php echo get_color(get_the_category($post->ID)[0]->name); ?>;"><?php echo $post->post_title; ?></h2>
									<p style="margin-bottom: 0px;"><?php echo $post->post_excerpt; ?></p>
								</a>
								<p class="post-meta">Posted in: <a href="<?php get_category_link(get_the_category($post->ID)[0]->cat_ID); ?>" style="color: <?php echo get_color(get_the_category($post->ID)[0]->name); ?>;"><strong><?php echo get_the_category($post->ID)[0]->name; ?></strong></a></p>
							</div>
						</div>
					</div>
					<hr/>
<?php
}
}
	}
?>  
                </div>
            </div>
            <div class="row">
            <style>
            .sbi_item.sbi_type_image {width: 150px;float: left;margin-right: 10px;}
            #sbi_load{clear: both;}
            </style>
                <div class="footer-col col-md-12">
                    <?php echo do_shortcode('[instagram-feed]'); ?>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
?>