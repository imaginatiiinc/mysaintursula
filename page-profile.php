<?php
session_start();

$page_fields = get_fields();
$user_fields = get_fields($_SESSION['level10']['purl_id']);

if(!empty($_POST)) {
	$mail_changes = false;
	
	foreach ($_POST as $key => $value) {
		if($user_fields[$key] != $value) $mail_changes = true;
		update_field($key, $value, $_SESSION['level10']['purl_id']);
		}
		
	if($mail_changes) {
	
		// multiple recipients
		// $to  = 'jblanton@blueskyci.com';
		$to  = 'bbeardsley@saintursula.org' . ', ';
		$to  = 'mspille@saintursula.org' . ', ';
		$to  = 'mlintner@saintursula.org' . ', ';
		$to .= 'mschwartz@blueskyci.com' . ', ';
		$to.='AMcGraw@ursulinesofcincinnati.org';
                //$to.='keyur4monto@gmail.com';
		// subject
		$subject = 'MySaintUrsula.com - Updated Purl';

		// message
		$message = '
		<html>
		<head>
		  <title>MySaintUrsula.com - Updated Purl</title>
		</head>
		<body>
		  <p>The following updated PURL information has been submitted. An asterisk indicates a change.</p>';
		foreach ($_POST as $key => $value) {
			if($user_fields[$key] != $value) {
				$message .= '<p><strong>' . $key . ':</strong> ' . $value . '*</p>'; 
				}
			else {
				$message .= '<p><strong>' . $key . ':</strong> ' . $value . '</p>'; 
				}
			}
		$message .= '
		</body>
		</html>
		';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: Maggie Schwartz <mschwartz@blueskyci.com> , Barb Bryans <bbryans@saintursula.org> , Mary Ellen Lintner <mlintner@saintursula.org> , Meridith Spille <mspille@saintursula.org> ,<bbryans@saintursula.org> , Bailey 	   Beardsley <bbeardsley@saintursula.org>' . "\r\n"; 
		$headers .= 'From: Updated Purl <no-reply@mysaintursula.com>' . "\r\n";

		mail($to, $subject, $message, $headers);
	
		}
	}

$page_fields = get_fields();
$user_fields = get_fields($_SESSION['level10']['purl_id']);

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
					<?php if(!empty($page_fields['banner_image']['url'])) { ?>
						<img src="<?php echo $page_fields['banner_image']['url']; ?>" class="img-responsive" />
					<?php } ?>
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
<?php 
foreach ($children as $child) {
	echo '						<a href="' . site_url($child->post_name) . '" style="color: rgb(1, 44, 95);">' . $child->post_title . '</a>';
	if($child !== end($children)) echo '&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;';
	}
?>
					</div>
				</div>
			</div>
<?php } ?>
		
            <div class="row">
                <div class="col-lg-12">
                    <h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
					<form method="post" action="<?php echo site_url('/profile/'); ?>" style="width: 50%; margin-top: 20px;">
						<div class="form-group">
							<label style="font-size: 20px;" for="prefix">Prefix</label>
							<input type="text" class="form-control" id="prefix" name="prefix" value="<?php echo $user_fields['prefix']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_fields['first_name']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="maiden_name">Maiden Name</label>
							<input type="text" class="form-control" id="maiden_name" name="maiden_name" value="<?php echo $user_fields['maiden_name']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="marriedlast_name">Married/Last Name</label>
							<input type="text" class="form-control" id="marriedlast_name" name="marriedlast_name" value="<?php echo $user_fields['marriedlast_name']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="suffix">Suffix</label>
							<input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $user_fields['suffix']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="class_year">Class Year</label>
							<input type="text" class="form-control" id="class_year" name="class_year" value="<?php echo $user_fields['class_year']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="address_1">Address 1</label>
							<input type="text" class="form-control" id="address_1" name="address_1" value="<?php echo $user_fields['address_1']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="address_2">Address 2</label>
							<input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo $user_fields['address_2']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="city">City</label>
							<input type="text" class="form-control" id="city" name="city" value="<?php echo $user_fields['city']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="state">State</label>
							<input type="text" class="form-control" id="state" name="state" value="<?php echo $user_fields['state']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="zip">Zip</label>
							<input type="text" class="form-control" id="zip" name="zip" value="<?php echo $user_fields['zip']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="cell_phone">Cell Phone</label>
							<input type="text" class="form-control" id="cell_phone" name="cell_phone" value="<?php echo $user_fields['cell_phone']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="home_phone">Home Phone</label>
							<input type="text" class="form-control" id="home_phone" name="home_phone" value="<?php echo $user_fields['home_phone']; ?>">
						</div>
						<div class="form-group">
							<label style="font-size: 20px;" for="e-mail_address">E-Mail Address</label>
							<input type="text" class="form-control" id="e-mail_address" name="e-mail_address" value="<?php echo $user_fields['e-mail_address']; ?>">
						</div>
						<button type="submit" class="btn btn-default" style="font-size: 20px;">Save Profile</button>
					</form>
                </div>
            </div>
        </div>
    </section>

<?php
endwhile; endif;
get_footer();
?>