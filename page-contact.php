<?php
$page_fields = get_fields();
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					
						<img src="http://mysaintursula.com/wp-content/uploads/2015/12/FullSizeRender.jpg" class="img-responsive" />
					
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php the_title(); ?></h2>
					<hr/>
					<?php the_content(); ?>
					<hr/>

                </div>
            </div>
        </div>
    </section>

<?php
endwhile; endif;
get_footer();
?>