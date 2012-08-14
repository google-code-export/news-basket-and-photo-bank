<h2><?php echo $breadcrumb?></h2>
<div class="detail">
	<div id="property" class="detail-left">
		<?php
			echo !empty($edit_user_form)? $this->load->view($edit_user_form) : $this->load->view($user_property);
		?>
		<br />
		<br />
		<br />

	</div>
</div>