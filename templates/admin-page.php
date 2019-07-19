<?php 
	// Fetch Insurance Links from JSON
	$filename = plugins_url('/assets/insurance-links.txt', dirname( __FILE__ ));

	$insurance_links = json_decode( file_get_contents( $filename ), true );

	if ( empty($insurance_links ) ) {
	    $errors .= "It looks like we are having issues fetching the insurance links. Please <a href='#'>contact</a> the plugin developer.";
	}
?>

<h1>Insurance Slider</h1>
<?php if( isset( $errors ) ) { ?>
	<div class="error_logs"><?php echo $errors; ?></div>
<?php } ?>

<!-- <pre><?php print_r($insurance_links); ?></pre> -->

<div class="insurance-list">
	
<?php 
foreach($insurance_links as $insurance) {
    $name = $insurance['name'];
    $url = $insurance['url'];
    $image_url = $insurance['image_url'];
?>

<div class="insurance-item">
	<img width="250" src="<?php echo $image_url; ?>">
	<label for="insurance_name">Partner Name:</label>
	<input type="text" name="insurance_name" value="<?php echo $name; ?>">
	<label for="insurance_name">Partner Link:</label>
	<input type="text" name="insurance_url" value="<?php echo $url; ?>">
</div>

<?php } ?>
</div>
