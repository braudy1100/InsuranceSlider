<div class="admin-wrapper">

	<div class="add-partner-modal">
		<div class="form-overlay"></div>
		<form id="add-partner-form">
			<a href="#" class="form-close">CLOSE</a>
			<h3>Add New Partner</h3>
			<input type="text" name="name" placeholder="Name">
			<input type="text" name="name" placeholder="URL">
			<input type="file" accept="image/*" name="name" placeholder="Image">
			<button class="admin-btn small">Add</button>
		</form>
	</div>

	<div class="admin-header">
		<h1>Insurance Slider</h1>
		<a class="admin-btn" href="#">Add New Partner</a>
	</div>

	<div class="loader">
		<img src="<?php echo plugins_url('/assets/spinner.gif', dirname( __FILE__ )); ?>">
	</div>
	
	<!-- display fetched data here -->
	<div class="partners"></div>

</div>