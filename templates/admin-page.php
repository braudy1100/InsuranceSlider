<div class="admin-wrapper" id="admin-top-page">
	<div class="add-partner-modal">
		<div class="form-overlay"></div>
		<form id="add-partner-form">
			<a href="#" class="form-close">CLOSE</a>
			<h3>Add New Partner</h3>
			<input id="name" type="text" name="name" placeholder="Name" required>
			<input id="url" type="text" name="url" placeholder="URL">
			<input id="imageUrl" type="file" accept="image/*" name="imageUrl" placeholder="Image" required>
			<button class="admin-btn small">Add</button>
		</form>
	</div>

	<div class="admin-header">
		<h1>Insurance Slider Database</h1>
		<div class="button-group">
			<a class="admin-btn form-open" href="#">Add New Partner</a>
			<a class="admin-btn btn-style2 update-btn" href="#">Save Changes</a>
		</div>
	</div>

	<div class="loader">
		<img src="<?php echo plugins_url('/assets/spinner.gif', dirname( __FILE__ )); ?>">
	</div>
	
	<!-- display fetched data here -->
	<div class="partners"></div>

</div>