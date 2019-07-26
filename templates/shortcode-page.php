<div class="admin-wrapper">
	<div class="admin-header no-flex">
		<h1>Shortcode</h1> 
		<pre><p>Use this shortcode [insurance slider]</p>
		</pre>
	</div>

	<script type="text/javascript">
		// create hidden setting
		let settings = JSON.parse("<?php echo get_option('plugin_settings'); ?>");
	</script>
	
	<div class="plugin_settings" hidden></div>
	<div class="admin-section">
		<div class="setting"><?php echo get_option('settings'); ?></div>
		<h2>Carrier Selector</h2>
		<p>Check the carriers/partners you want to display on the slider:</p>
		<fieldset class="partners-fieldset">      
    		
    	</fieldset>
    	<button class="admin-btn" id="save-settings">Save</button>
	</div>
</div>