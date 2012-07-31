
	<title><?$page_title;?></title>
	<h2>Create New Album</h2>
		<?php $flashmessage = $this->session->flashdata('message')?>
		
			
		
	
		
	
	<div class="well">
		<?php  echo form_open('album/add');?>
		<fieldset>
			<legend>Album Information</legend>
			
				<?php echo ! empty($flashmessage) ? '<p class="alert alert-error">' . $flashmessage . '</p>': '';?>
		
			
			<label for="album">Album Name</label>
		 <input name="album" value="" type="text">	
		 </fieldset>
		<button name="submit" type="submit" id="submit" value="Add" class="btn btn-primary">Add</button>
		<a class="btn" href="<?php echo site_url('album/index');?>">Cancel</a>
	<?php echo form_close();?>
	
<script type="text/javascript">
$(document).ready(function() {
  $('form:not(.filter) :input:visible:first').focus();
});
</script>
		
	</div>
	
	
	
	
