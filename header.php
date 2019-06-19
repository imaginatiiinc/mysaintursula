<?php
error_reporting(0);
session_start();

if(get_the_title(get_the_id()) == 'Logout') {
	session_destroy();
	// wp_redirect( get_site_url() . '/purlnotfound/');
	// exit();
	}
else {


	if(empty($_SESSION['level10']['purl_id']) && get_post_type(get_the_id()) != 'purl' && get_the_title(get_the_id()) != 'PURL Not Found') {
		wp_redirect( get_site_url() . '/purlnotfound/');
		exit();
		}
		
	if(is_front_page()) {
	/* 	if(empty($_SESSION['level10']['purl_id'])) wp_redirect( get_site_url() . '/purlnotfound/');
		else wp_redirect( get_site_url() . '/?p=' . $_SESSION['level10']['purl_id']);
		exit(); */
		}
		
	if(get_the_title(get_the_id()) == 'Interests') {
		$fields = get_fields($_SESSION['level10']['purl_id']);
		wp_redirect( get_site_url() . '/?p=' . $fields['interests'][0]);
		exit();
		}

	if(get_post_type(get_the_id()) == 'purl') {
		if(!empty($_SESSION['level10']['purl_id'])) {
			if($_SESSION['level10']['purl_id'] != get_the_id()) {
				session_destroy();
				session_start();
				}
			}
		$_SESSION['level10']['purl_id'] = get_the_id();
		}

	if(empty($_SESSION['level10']['visit_id'])) {
		if(!empty($_SESSION['level10']['purl_id'])) {
			$wpdb->insert( 
				'l10_visits', 
				array( 
					'purl_id' => $_SESSION['level10']['purl_id'], 
					'date' => time() 
					)
				);
			$_SESSION['level10']['visit_id'] = $wpdb->insert_id;
			}
		}
	else {
		$id = get_the_id();
		if(!empty($id)) {
			$wpdb->insert( 
				'l10_visit_meta', 
				array( 
					'visit_id' => $_SESSION['level10']['visit_id'], 
					'visit_meta_key' => 'page_view', 
					'visit_meta_value' => get_the_id() 
					)
				);
			}
			
		if(is_category()) {
			global $cat;
			$wpdb->insert( 
				'l10_visit_meta', 
				array( 
					'visit_id' => $_SESSION['level10']['visit_id'], 
					'visit_meta_key' => 'category_view', 
					'visit_meta_value' => $cat 
					)
				);
			}
		}
	if(get_post_type(get_the_id()) == 'purl') {
		wp_redirect( get_site_url());
		exit();
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MySaintUrsula.com</title>
	
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/mysaintursula.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-gravity-forms.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
</head>

<body class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" /></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="page-scroll"><a href="<?php echo site_url(); ?>">Home</a></li>
                    <li class=""><a href="<?php echo site_url('/weddings/contract/'); ?>">Weddings</a></li>
                    <li class=""><a href="<?php echo site_url('/calendar/'); ?>">Calendar</a></li>
                    <li class=""><a href="<?php echo site_url('/contact/'); ?>">Contact</a></li>
                    <li class=""><a href="<?php echo site_url('/profile/'); ?>">Profile</a></li>
                    <li class=""><a href="<?php echo site_url('/weddingsbabiesandclassnotes/'); ?>">Class notes</a></li>
                    <li class=""><a href="<?php echo site_url('/jobposting/'); ?>">Job Posting</a></li>
                    <li class=""><a href="<?php echo site_url('/logout/'); ?>">Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>